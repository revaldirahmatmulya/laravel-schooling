<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{

    public function index()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.author.index');
    }

    public function create()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.author.add');
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
                'location' => ['required', 'max:100'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'location' => __('attributes.location'),
            ],
        )->validate();

        $insert = Author::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        if ($insert) {
            Alert::toast('Data Penulis Berhasil ditambahkan.', 'success');
        } else {
            Alert::toast('Data Penulis gagal ditambahkan.', 'error');
        }

        return redirect()->to(route('perpustakaan.author.index'))->with('success', 'Data Penulis Berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Author $Author)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.author.edit', ['Author' => $Author]);
    }

    public function update(Request $request, Author $Author)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
                'location' => ['required', 'max:100'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'location' => __('attributes.location'),
            ],
        )->validate();


        $data = [
            'name' => $request->name,
            'location' => $request->location,
        ];

        if ($Author->update($data)) {
            Alert::toast('Data Penulis Berhasil diubah.', 'success');
        } else {
            Alert::toast('Data Penulis Gagal diubah.', 'error');
        }

        return redirect()->to(route('perpustakaan.author.index'));
    }

    public function destroy(Author $Author)
    {
        if ($Author->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Penulis berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Penulis tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }
}
