<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Rental;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\BorrowingFine;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{

    public function index(Rental $rental)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        $late = Rental::get('return_date');
        return view('pages.perpustakaan.rental.index', compact('late'));
    }

    public function data()
    {
            return DataTables::of(Rental::latest()->get()->load('student.user', 'book'))
            ->editColumn('created_at', function ($rental) {
                return $rental->created_at->format('d-m-Y');
            })
            ->make(true);
    }

    public function show(Rental $rental){
        return view('pages.perpustakaan.rental.show', [
            'rental' => $rental,
            'fine' => BorrowingFine::where('rental_id', $rental->id)->first()
        ]);
    }

    public function create()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.rental.add', [
            'books' => Book::all(),
            'students' => Student::all(),
            'rentals' => Rental::all()
        ]);
    }

    public function store(Request $request, Rental $rental)
    {

        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required'],
                'student' => ['required'],
                'status' => ['required'],
                'created_at' => ['required'],
                'return_date' => ['required', 'after:created_at'],
            ],
            customAttributes: [
                'title' => __('attributes.title'),
                'status' => __('attributes.status'),
                'student' => __('attributes.student'),
                'return_date' => __('attributes.return_date'),
            ],
            messages: [
                'status' => 'Status wajib diisi',
                'return_date' => 'Tanggal harus setelah tanggal hari ini.',
            ]
        )->validate();


        $rental = Rental::create([
            'book_id' => $request->title,
            'student_id' => $request->student,
            'status' => $request->status,
            'created_at' => $request->created_at,
            'return_date' => $request->return_date,
            'returned_at' => null,
        ]);

        if ($rental) {
            $buku = Book::where('id', $request->title)->first();
            if($buku->stock >= 1){
                $buku->stock -= 1;
                $buku->save();
                Alert::toast('Data Peminjam Berhasil Ditambahkan.', 'success');
                return redirect()->to(route('perpustakaan.rental.index'));
            }else {
                Alert::error('Buku Habis', 'Maaf buku telah habis dipinjam'); 
                return redirect()->to(route('perpustakaan.rental.add'));
            }
        } else {
            Alert::toast('Data Peminjam gagal ditambahkan.', 'error');
            return redirect()->to(route('perpustakaan.rental.index'))->with('error', 'Data Peminjam Buku Gagal ditambahkan.');
        }
    }

    public function turned(Rental $rental, Request $request)
    {

        //count deviation of late return
        $return_date = new DateTime($rental->return_date);
        $returned_at = new DateTime($rental->returned_at);
        $jumlah_telat = date_diff($returned_at, $return_date)->format('%r%a');
        $intfine =  strval(date_diff($returned_at, $return_date)->format("%r%a"));
        $total_denda = abs($jumlah_telat) * 5000;

        // autofill status
        $status = "";
        if($jumlah_telat < 0){
            $status = "returned_late";
        } else{
            $status = "completed";
        }

        $denda = "";
        if($jumlah_telat >= 0){
            $denda = 0;
        }else {
            $denda = $total_denda;
        }

        $late_date = "";
        if(strval($intfine >= 0)){
            $late_date = 0;
        }else {
            $late_date = abs($intfine);
        }

        if ($status) {
            $buku = Book::where('id', $rental->book->id)->first();
            $buku->stock += 1;
            $buku->save();
        }

        DB::transaction(function () use ($rental, $request, $jumlah_telat, $total_denda, $status, $intfine, $denda, $late_date) {
            $update = $rental->update([
                'status' => $status,
                'returned_at' => Carbon::now(),
            ]);

            $fine = BorrowingFine::where('rental_id', $rental)->create([
                'rental_id' => $rental->id,
                'description' => "Buku Telat Dikembalikan " . $late_date . " Hari",
                'fine' => $denda,
            ]);

            if ($update && $fine) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Buku berhasil dikembalikan',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Buku gagal dikembalikan!',
                );
            }   
            echo json_encode($response);   
        });
    }

    
    public function edit(Rental $rental)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        $idbuku = $rental->book_id;
        return view('pages.perpustakaan.rental.edit', [
            'rentals' => $rental,
            'allrentals' => Rental::all()->pluck('status'),
            'books' => Book::all(),
            'students' => Student::all(),
            'buku' => Rental::where('book_id', $idbuku)->get(),
        ]);
    }

    public function update(Request $request, Rental $rental)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required'],
                'student' => ['required'],
                'status' => ['required'],
                'created_at' => ['required'],
                'return_date' => ['required', 'after:created_at'],
            ],
            customAttributes: [
                'title' => __('attributes.title'),
                'student' => __('attributes.student'),
                'return_date' => __('attributes.return_date'),
            ],
            messages: [
                'return_date' => 'tanggal tidak boleh sebelum tanggal buku dipinjam',
            ]
        )->validate();

        $data = [
            'book_id' => $request->title,
            'student_id' => $request->student,
            'status' => $request->status,
            'created_at' => $request->created_at,
            'return_date' => $request->return_date,
        ];

        //count deviation of late return
        $return_date = new DateTime($rental->return_date);
        $returned_at = new DateTime($rental->returned_at);
        $jumlah_telat = date_diff($returned_at, $return_date)->format("Total telat: %a hari.");
        $intfine =  strval(date_diff($returned_at, $return_date)->format("%a"));
        $total_denda = $intfine * 5000;
            
            if($request->status == 'ongoing'){
                $update = $rental->update($data);

                if ($update) {
                    Alert::toast('Data Peminjam Berhasil Ditambahkan.', 'success');
                } else {
                    Alert::toast('Data Peminjam gagal ditambahkan.', 'error');
                }

            } else if ($request->status == 'returned_late' || $request->status == 'completed'){
                if($rental->returned_at == null ){
                        $rental->update([
                            'book_id' => $request->title,
                            'student_id' => $request->student,
                            'status' => $request->status,
                            'created_at' => $request->created_at,
                            'return_date' => $request->return_date,
                            'returned_at' => Carbon::now()
                    ]);
                    BorrowingFine::where('rental_id', $rental)->create([
                        'rental_id' => $rental->id,
                        'description' => $jumlah_telat,
                        'fine' => $total_denda,
                    ]);

                    if ($rental) {
                        Alert::toast('Data Peminjam Berhasil Ditambahkan.', 'success');
                    } else {
                        Alert::toast('Data Peminjam gagal ditambahkan.', 'error');
                    }
                }
            }
            
            return redirect()->to(route('perpustakaan.rental.index'))->with('success', 'Data Buku Peminjam Diedit.');
    }

    public function destroy(Rental $rental)
    {
        $buku = Book::where('id', $rental->book->id)->first();

        if($rental->delete()){
                $buku->stock += 1;
                $buku->save();
                $rental->delete();
                $response = array(
                    'status' => 'success',
                    'message' => 'Data Peminjam berhasil dihapus',
                );
        }  else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Peminjam gagal dihapus!',
            );
        }

        echo json_encode($response);
    }
}
