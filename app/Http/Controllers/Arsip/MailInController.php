<?php

namespace App\Http\Controllers\Arsip;

use App\Models\MailIn;
use App\Models\MailCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MailInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return MailIn::all()->load(['category', 'disposition'])->append(['tanggal_masuk', 'tanggal_diterima']);
        return view('pages.arsip.mailin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (MailCategory::count() == 0) {
            Alert::warning('Kategori Surat Masuk Kosong', 'Silahkan tambahkan kategori surat masuk terlebih dahulu');
            return redirect()->route('arsip.surat.in.index');
        }


        return view('pages.arsip.mailin.add', ['categories' => MailCategory::all()]);
    }

    public function data()
    {
        return DataTables::of(MailIn::latest()->get()->load('disposition'))->make(true);
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
                'sender' => ['required', 'string'],
                'title' => ['required', 'string'],
                'category' => ['required', 'exists:mail_categories,id'],
                'file' => ['file', 'mimes:pdf,png,jpg,jpeg', 'max:10240 '],
            ],
            customAttributes: [
                'sender' => __('attributes.sender'),
                'title' => __('attributes.title'),
                'category' => __('attributes.category'),
                'file' => __('attributes.file'),
            ]
        )->validate();


        $insert = MailIn::create([
            'sender' => $request->sender,
            'title' => $request->title,
            'mail_category_id' => $request->category,
            'file' => !empty($request->file('file')) ? Storage::put('public/archive/in', $request->file('file')) : '',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('arsip.surat.in.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MailIn  $mailIn
     * @return \Illuminate\Http\Response
     */
    public function show(MailIn $mailIn)
    {
        return redirect()->to(route('arsip.surat.in.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MailIn  $mailIn
     * @return \Illuminate\Http\Response
     */
    public function edit(MailIn $mailIn)
    {
        return view('pages.arsip.mailin.edit', ['mailIn' => $mailIn, 'categories' => MailCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MailIn  $mailIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailIn $mailIn)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'sender' => ['required', 'string'],
                'title' => ['required', 'string'],
                'category' => ['required', 'exists:mail_categories,id'],
                'file' => ['file', 'mimes:pdf,png,jpg,jpeg', 'max:10240 '],
            ],
            customAttributes: [
                'sender' => __('attributes.sender'),
                'title' => __('attributes.title'),
                'category' => __('attributes.category'),
                'file' => __('attributes.file'),
            ]
        )->validate();

        if ($request->file('file')) {
            Storage::disk()->delete($mailIn->file);
        }

        $data = [
            'sender' => $request->sender,
            'title' => $request->title,
            'mail_category_id' => $request->category,
        ];
        if ($request->file('file')) {
            $data['file'] = Storage::put('public/archive/in', $request->file('file'));
        }

        if ($mailIn->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        } else {
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('arsip.surat.in.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MailIn  $mailIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailIn $mailIn)
    {
        if ($mailIn->delete()) {
            if ($mailIn->file != '') {
                Storage::disk('public')->delete($mailIn->file);
            }
            $response = array(
                'status' => 'success',
                'message' => 'Surat Masuk berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Surat Masuk tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }
}
