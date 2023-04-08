<?php

namespace App\Http\Controllers\Akademik;

use App\Enums\PositionType;
use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ParentsController extends Controller
{
    public function index()
    {        
        return view('pages.akademik.parents.index');
    }

    public function data()
    {

        return DataTables::of(Parents::get()->load('user','students','students.user'))
        ->addColumn('childrens', function($data){
            $childrens = '<ul>';
            foreach($data->students as $student){
                $childrens .= '<li>'.$student->user->name. '</li>';
            }
            $childrens .= '</ul>';
            return $childrens;
        })
        ->rawColumns(['childrens'])
        ->make(true);
    }

    public function create()
    {

        return view('pages.akademik.parents.add', ['students' => Student::where('parent_id', null)->get()->load('user')]);
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required'],
                'email' => ['required', Rule::unique(User::class)],
                'phone' => ['required', 'regex:/(08)[0-9]/'],
                'address' => ['required'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'email' => __('attributes.email'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
            ],
            messages: [
                'regex' => __('validation.regex'),
            ]
        )->validate();

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'position_id' => PositionType::Parents,
            ]);            

            $parent = Parents::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            if ($request->students) {
                foreach ($request->students as $student) {
                    Student::find($student)->update(['parent_id' => $parent->id]);
                }
            }

            if ($user && $parent) {
                Alert::toast('Berhasil Menambah data Orang Tua Siswa.', 'success');
            } else {
                Alert::toast('Gagal Menambah data Orang Tua Siswa.', 'error');
            }
        });
        return redirect()->to(route('akademik.users.parents.index'));
    }

    public function edit($id)
    {
        $parents = Parents::find($id)->load('user', 'students');
        $children = $parents->students->pluck('id')->toArray();

        return view(
            'pages.akademik.parents.edit',
            [
                'parents' => $parents,
                'students' => Student::where('parent_id',null)->orWhereIn('id', $children)->get()->load('user'),
                'children' => $children,
            ]
        );
    }

    public function update(Request $request, Parents $parents)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required'],
                'email' => ['required', Rule::unique(User::class)->ignore($parents->user->id)],
                'phone' => ['required', 'regex:/(08)[0-9]/'],
                'address' => ['required'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'email' => __('attributes.email'),
                'phone' => __('attributes.phone'),
                'address' => __('attributes.address'),
            ],
            messages: [
                'regex' => __('validation.regex'),
            ]
        )->validate();

        DB::transaction(function () use ($request, $parents) {
            $user = User::find($parents->user_id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $parents->update([
                'phone' => $request->phone,
                'address' => $request->address,
            ]);            

            if ($request->students) {
                $parents->students()->update(['parent_id' => null]);
                foreach ($request->students as $student) {
                    Student::find($student)->update(['parent_id' => $parents->id]);
                }
            }else{
                $parents->students()->update(['parent_id' => null]);
            }

            if ($user && $parents) {
                Alert::toast('Berhasil Mengubah data Orang Tua Siswa.', 'success');
            } else {
                Alert::toast('Gagal Mengubah data Orang Tua Siswa.', 'error');
            }
        });
        return redirect()->to(route('akademik.users.parents.index'));
    }

    public function destroy(Parents $parents)
    {
        $parents->students()->update(['parent_id' => null]);
        $user = $parents->user;

        if ($user->status != 'root') {
            $user->delete();
            $response = array(
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            );
        } elseif ($user->status == 'root') {
            $response = array(
                'status' => 'error',
                'message' => 'Root can\'t be deleted!',
            );
        }

        echo json_encode($response);
    }
}
