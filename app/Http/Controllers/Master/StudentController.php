<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.student.add', ['classes' => Classes::where('status', 1)->get()]);
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
                'nis' => ['required','numeric', Rule::unique(student::class)],
                'nisn' => ['required','numeric', Rule::unique(student::class)],
                'name' => ['required', 'max:200'],
                'email' => ['required','email' ,Rule::unique(User::class)],
                'gender' => ['required'],
                'class' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'phone' => ['required', 'max:20', 'regex:/(08)[0-9]/'],
                'address' => ['required'],
                'status' => ['required'],
                'generation' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'class' => __('attributes.class'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                'generation' => __('attributes.generation'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        // return $request->all();

        $add_user = User::create([
            'name' => $request->name,
            'username' => $request->nis,
            'position_id' => 4,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'is_active' => $request->status,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);


        if (!$add_user) {
            Alert::toast('Gagal menambahkan akun siswa.', 'error');
            return redirect()->to(route('master.users.student.index'));
        }


        $insert = Student::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'user_id' => $add_user->id,
            'classes_id' => $request->class,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'generation' => $request->generation,
            'alumni' => 0,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'address' => $request->address,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('master.users.student.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::with('user', 'class')->where('id', $student->id)->first();
        return view('pages.master.student.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('pages.master.student.edit', ['student' => $student, 'classes' => Classes::where('status', 1)->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'nis' => ['required','numeric', Rule::unique(Student::class)->ignore($student->id)],
                'nisn' => ['required','numeric', Rule::unique(Student::class)->ignore($student->id)],
                'name' => ['required', 'max:200'],
                'email' => ['required', Rule::unique(User::class)->ignore($student->user->id)],
                'gender' => ['required'],
                'class' => ['required'],
                'birthplace' => ['required'],
                'birthdate' => ['required'],
                'religion' => ['required', 'max:20'],
                'generation' => ['required', 'max:5'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
                'status' => ['required'],
                // 'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'email' => __('attributes.email'),
                'gender' => __('attributes.gender'),
                'class' => __('attributes.class'),
                'birthplace' => __('attributes.birthplace'),
                'birthdate' => __('attributes.birthdate'),
                'religion' => __('attributes.religion'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
                'generation' => __('attributes.generation'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        $update_user = $student->user->update([
            'name' => $request->name,
            'username' => $request->nis,
            'email' => $request->email,
            'is_active' => $request->status,
        ]);

        $update = $student->update([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'class' => $request->class,
            'gender' => $request->gender,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'religion' => $request->religion,
            'generation' => $request->generation,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'address' => $request->address,
        ]);

        if ($update && $update_user) {
            Alert::toast('Berhasil Mengubah data Siswa.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data Siswa.', 'error');
        }

        return redirect()->to(route('master.users.student.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $user = Student::find($request->id);
            if ($user->user->status != 'root') {
               
                    if ($user->user->update(['is_active' => $isactive])) {
                        if ($isactive == '0') {
                            $message1 = "Pengguna Berhasil di non aktifkan";
                        } else {
                            $message1 = "Pengguna Berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'success',
                            'message' => $message1,
                        );
                    } else {
                        if ($isactive == '0') {
                            $message2 = "Pengguna tidak berhasil di non aktifkan";
                        } else {
                            $message2 = "Pengguna tidak berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'error',
                            'message' => $message2,
                        );
                    }                
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Root tidak bisa dinonaktifkan',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan!',
            );
        }
        echo json_encode($response);
    }
    public function data()
    {
        return DataTables::of(Student::latest()->NotAlumni()->get()->load('user', 'user.position', 'class'))->make(true);
    }
}
