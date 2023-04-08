<?php

namespace App\Http\Controllers\Master;

use App\Enums\PositionType;
use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::all()->load('position');
        return view('pages.master.users.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.users.add', [
            'positions' => Position::whereNotIn(
                'id',
                [
                    PositionType::Student,
                    PositionType::Teacher,
                    PositionType::Parents,
                    PositionType::Alumni
                ]
            )->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'jabatan' => ['required'],
            'username' => ['required', Rule::unique(User::class)],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'password' => ['required', Password::min(6)->mixedCase()],
            're-password' => ['required', 'same:password', Password::min(6)->mixedCase()],
        ]);



        User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'position_id' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
            'is_active' => 0,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(route('master.users.admin.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->to(route('master.users.admin.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.master.users.edit', ['user' => $user, 'positions' => Position::whereNotIn(
            'id',
            [
                PositionType::Student,
                PositionType::Teacher,
                PositionType::Parents,
                PositionType::Alumni
            ]
        )->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => ['required'],
            'jabatan' => ['required'],
            'username' => ['required', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => [Password::min(6)->mixedCase()],
            ]);
        }
        
        if ($user->status == 'root') {
            Alert::error('Gagal', 'Tidak dapat mengubah akun root');
            return redirect()->back();
        }

        $data = [
            'name' => $request->nama,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'email' => $request->email,
        ];
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        
        $update = $user->update($data);

        if ($update) {
            Alert::success('Berhasil', 'Berhasil mengubah data');
        } else {
            Alert::error('Gagal', 'Gagal mengubah data');
        }

        return redirect()->to(route('master.users.admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
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

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }


            $user = User::find($request->id);
            if ($user->status != 'root') {
                if ($user->update(['is_active' => $isactive])) {
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
}
