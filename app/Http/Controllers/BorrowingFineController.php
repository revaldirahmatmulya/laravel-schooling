<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BorrowingFine as ControllersBorrowingFine;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Rental;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\BorrowingFine;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;

class BorrowingFineController extends Controller
{

    public function index(Rental $rental)
    {   
        if (BorrowingFine::where('rental_id', $rental->id)->count() == 0) {
            Alert::toast('Silahkan kembalikan buku terlebih dahulu', 'error');
            return redirect()->route('perpustakaan.rental.index');
        }
        return view('pages.perpustakaan.borrowingfine.index', [
            'rental' => $rental
        ]);
    }

    public function data(Rental $rental)
    {
        //showing data denda berdasarkan student id
        return DataTables::of(BorrowingFine::where('rental_id', $rental->id)->get()->load('rental.student.user', 'rental.book'))->make(true);
    }

    public function edit(Rental $rental, BorrowingFine $fine)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.borrowingfine.edit', [
            'fine' => $fine,
            // 'rental' =>$rental->id,
            'rentals' => $rental
        ]);
    }

    public function update(Request $request, Rental $rental, BorrowingFine $fine)
    {
        
        Validator::make(
            data: $request->all(),
            rules: [
                'fine' => ['required', 'numeric', 'min:0'],
                'description' => ['required']
            ],
            customAttributes: [
                'fine' => __('attributes.fine'),
                'description' => __('attributes.description'),
            ],
            messages: [
                'fine' => 'Data denda wajib diisi.',
            ]
        )->validate();

        // $updatedata = $borrowingFine::where('id', $request->route('fine'));

        $update = $fine->update([
            'fine' => $request->fine,
            'description' => $request->description
        ]);

        if ($update) {
            Alert::toast('Berhasil mengubah data denda', 'success');
        } else {
            Alert::toast('Gagal mengubah data denda', 'error');
        }

        return redirect()->to(route('perpustakaan.fine.index', ['rental' => $rental]))->with('success', 'Data Denda Berhasil Diubah.');

    }
}
