<?php

namespace App\Http\Controllers\Arsip;

use App\Models\MailIn;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MailOut;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MailIn $mailIn)
    {
        return view('pages.arsip.disposition.add', ['mailIn' => $mailIn]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MailIn $mailIn)
    {

        Validator::make(
            data: $request->all(),
            rules: [
                'message' => ['required', 'string'],
                'destination' => ['required', 'string'],
            ],
            customAttributes: [
                'message' => 'Isi Disposisi',
                'destination' => 'Tujuan Disposisi',
            ]
        )->validate();


        DB::transaction(function () use ($request, $mailIn) {
            $mailIn->update([
                'is_disposed' => true,
            ]);

            $insert = Disposition::create([
                'mail_in_id' => $mailIn->id,
                'destination' => $request->destination,
                'message' => $request->message,
            ]);

            $insertOut = MailOut::create([                
                'receiver' => $request->destination,
                'title' => 'Disposisi Surat Masuk - ' . $mailIn->title,
                'mail_category_id' => $mailIn->mail_category_id,
                'file' => $mailIn->file,
            ]);

            if ($insert && $insertOut) {
                Alert::toast('Berhasil menambah Disposisi.', 'success');
            } else {
                Alert::toast('Gagal menambah Disposisi.', 'error');
            }
        });


        return redirect()->to(route('arsip.surat.in.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function edit($disposition)
    {
        // return $disposition->load('disposition');
        return view('pages.arsip.disposition.edit', ['disposition' => $disposition->load('disposition')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailIn $disposition)
    {
        $disposition = $disposition->load('disposition');
        Validator::make(
            data: $request->all(),
            rules: [
                'disposisi' => ['required', 'max:200'],
                'sifat_disposisi' => ['required', 'max:200'],
                'isi_disposisi' => ['required', 'max:200'],
            ],
        )->validate();


        $data = [
            'mail_destination' => $request->disposisi,
            'status' => $request->sifat_disposisi,
            'description' => $request->isi_disposisi,
        ];

        if ($disposition->disposition->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        } else {
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('arsip.surat.in.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disposition  $disposition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disposition $disposition)
    {
    }
}
