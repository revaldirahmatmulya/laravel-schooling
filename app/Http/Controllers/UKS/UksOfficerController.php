<?php

namespace App\Http\Controllers\UKS;

use App\Models\Student;
use App\Models\UksOfficer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UksOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.uks.officer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::latest()->NotAlumni()->get()->load('user', 'class');
        return view('pages.uks.officer.add', ['students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'petugas' => ['required', 'max:20'],
                'hari' => ['required', 'max:20'],
                'jam_mulai' => ['required', 'max:20'],
                'jam_selesai' => ['required', 'max:20'],
            ],
            customAttributes: [
                // 'name'=> __('attributes.name'),
                // 'description'=> __('attributes.description'),
            ],
        )->validate();
        

        $insert = UksOfficer::create([
            'student_id' => $request->petugas,
            'day' => $request->hari,
            'time_start' => $request->jam_mulai,
            'time_end' => $request->jam_selesai,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('uks.petugas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UksOfficer  $uksOfficer
     * @return \Illuminate\Http\Response
     */
    public function show(UksOfficer $uksOfficer)
    {
        return redirect()->to(route('uks.petugas.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UksOfficer  $uksOfficer
     * @return \Illuminate\Http\Response
     */
    public function edit(UksOfficer $uksOfficer)
    {
        $students = Student::latest()->NotAlumni()->get()->load('user', 'class');
        return view('pages.uks.officer.edit', ['uksOfficer' => $uksOfficer, 'students' => $students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UksOfficer  $uksOfficer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UksOfficer $uksOfficer)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'petugas' => ['required', 'max:20'],
                'hari' => ['required', 'max:20'],
                'jam_mulai' => ['required', 'max:20'],
                'jam_selesai' => ['required', 'max:20'],
            ],
            customAttributes: [
                // 'name'=> __('attributes.name'),
                // 'description'=> __('attributes.description'),
            ],
        )->validate();


        $data = [
            'student_id' => $request->petugas,
            'day' => $request->hari,
            'time_start' => $request->jam_mulai,
            'time_end' => $request->jam_selesai,
        ];

        if ($uksOfficer->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('uks.petugas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UksOfficer  $uksOfficer
     * @return \Illuminate\Http\Response
     */
    public function destroy(UksOfficer $uksOfficer)
    {
        if ($uksOfficer->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Petugas berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Petugas tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        $data = UksOfficer::query()->with([
            'Student' => function ($query) {
                $query
                ->select('id', 'classes_id', 'user_id')
                ->with([
                    'Class' => function ($querys) {
                        $querys->select('id', 'code');
                    },
                    'User' => function ($querys) {
                        $querys->select('id', 'name');
                    },
                ]);
            },
        ])
        ->get();
        return DataTables::of($data)->make(true);
    }
}
