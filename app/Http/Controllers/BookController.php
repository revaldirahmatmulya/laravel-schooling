<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function index() 
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.book.index');
    }

    public function create()
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.book.add', [
            'categories' => BookCategory::all(),
            'authors' => Author::all()
        ]);
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'code' => ['required'],
                'title' => ['required'],
                'location' => ['required'],
                'stock' => ['required'],
                'author' => ['required'],
                'category' => ['required'],
            ],
            customAttributes: [
                'code' => __('attributes.code'),
                'title' => __('attributes.title'),
                'author' => __('attributes.author'),
                'category' => __('attributes.category'),
                'location' => __('attributes.location'),
            ],
            messages: [
                'code' => 'Kode Buku harus diisi.',
            ]
        )->validate();

        $insert = Book::create([
            'code' => $request->code,
            'title' => $request->title,
            'location' => $request->location,
            'stock' => $request->stock,
            'author_id' => $request->author,
            'category_id' => $request->category,
        ]);

        if ($insert) {
            Alert::toast('Data buku Berhasil ditambahkan.', 'success');
        } else {
            Alert::toast('Data buku gagal ditambahkan.', 'error');
        }

        return redirect()->to(route('perpustakaan.book.index'))->with('success', 'Data Buku Berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Book $book)
    {
        if (!auth()->user()->position->id || (auth()->user()->position->id != 1 && auth()->user()->position->id != 9) ) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('master.dashboard');
        }
        return view('pages.perpustakaan.book.edit', [
            'books' => $book,
            'authors' => Author::all(),
            'categories' => BookCategory::all()
        ]);
    }

    public function update(Request $request, Book $book)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'code' => ['required'],
                'title' => ['required'],
                'location' => ['required'],
                'stock' => ['required'],
                'author' => ['required'],
                'category' => ['required'],
            ],
            customAttributes: [
                'code' => __('attributes.code'),
                'title' => __('attributes.title'),
                'author' => __('attributes.author'),
                'category' => __('attributes.category'),
                'location' => __('attributes.location'),
            ],
            messages: [
                'code' => 'Kode Buku harus diisi.',
            ]
        )->validate();

        $data = [
            'code' => $request->code,
            'title' => $request->title,
            'location' => $request->location,
            'stock' => $request->stock,
            'author_id' => $request->author,
            'category_id' => $request->category,
        ];

        if ($book->update($data)) {
            Alert::toast('Data buku Berhasil diupdate.', 'success');
        } else {
            Alert::toast('Data buku gagal diupdate.', 'error');
        }

        return redirect()->to(route('perpustakaan.book.index'))->with('success', 'Data Buku Berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        if ($book->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Buku berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Buku tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }
}
