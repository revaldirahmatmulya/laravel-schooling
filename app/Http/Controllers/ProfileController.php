<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pages.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore(auth()->user()->id)],
            'old_password' => ['required'],
        ]);        

        if (isset($request->password)) {
            $request->validate([
                'password' => [Password::min(6)->mixedCase(), 'confirmed'],
            ]);
        }

        if (auth()->user()->status == 'root') {
            Alert::error('Gagal', 'Tidak dapat mengubah akun root');
            return redirect()->back();
        }

        if (Hash::check($request->old_password, auth()->user()->password)) {
            $data = [
                'name' => $request->nama,
                'email' => $request->email,
            ];
            if (isset($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
    
            $update = User::where('id', auth()->user()->id)->update($data);
    
            if ($update) {
                Alert::success('Berhasil', 'Berhasil mengubah data');
            } else {
                Alert::error('Gagal', 'Gagal mengubah data');
            }    
        }else{
            Alert::error('Gagal', 'Password lama salah');
        }

        return redirect()->back();
    }
}
