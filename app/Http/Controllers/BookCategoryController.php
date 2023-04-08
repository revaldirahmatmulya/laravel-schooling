<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookCategoryController extends Controller
{

    public function index()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.bookcategory.index');
    }

    public function create()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.bookcategory.add');
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ], 
        )->validate();

        $insert = BookCategory::create([
            'name' => $request->name,
        ]);

        if ($insert) {
            Alert::toast('Kategori Buku Berhasil ditambahkan.', 'success');
        } else {
            Alert::toast('Kategori Buku gagal ditambahkan.', 'error');
        }

        return redirect()->to(route('perpustakaan.category.index'))->with('success', 'Kategori Buku Berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit(BookCategory $bookcategory)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.bookcategory.edit', ['category' => $bookcategory]);
    }


    public function update(Request $request, BookCategory $bookcategory)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:100'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
            ],
        )->validate();


        $data = [
            'name' => $request->name,
        ];

        if ($bookcategory->update($data)) {
            Alert::toast('Kategori Buku Berhasil diubah.', 'success');
        } else {
            Alert::toast('Kategori Buku Gagal diubah.', 'error');
        }

        return redirect()->to(route('perpustakaan.category.index'));
    }

    public function destroy(BookCategory $bookcategory)
    {
        if ($bookcategory->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Berita berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Berita tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }
}
