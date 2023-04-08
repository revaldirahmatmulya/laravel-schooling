<?php

namespace App\Http\Controllers\Arsip;

use App\Models\MailOut;
use App\Models\MailCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MailOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return view('pages.arsip.mailout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.arsip.mailout.add', ['categories' => MailCategory::all()]);
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
                'receiver' => ['required', 'string'],
                'title' => ['required', 'string'],
                'category' => ['required', 'exists:mail_categories,id'],
                // 'file' => ['required', 'file', 'mimes:pdf'],                
            ],
            customAttributes: [
                'receiver' => __('attributes.receiver'),
                'title' => __('attributes.title'),
                'category' => __('attributes.category'),
                // 'file' => __('attributes.file'),
            ]
        )->validate();        
                        
        $insert = MailOut::create([
            'receiver' => $request->receiver,
            'title' => $request->title,
            'mail_category_id' => $request->category,            
            'file' => !empty($request->file('file')) ? Storage::put('public/archive/out', $request->file('file')) : '',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data surat keluar.', 'success');
        }else{
            Alert::toast('Gagal menambah data surat keluar.', 'error');
        }        

        return redirect()->to(route('arsip.surat.out.index'));
    }

    public function data()
    {
        return DataTables::of(MailOut::latest()->get())->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MailOut  $mailOut
     * @return \Illuminate\Http\Response
     */
    public function show(MailOut $mailOut)
    {
        return redirect()->to(route('arsip.surat.out.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MailOut  $mailOut
     * @return \Illuminate\Http\Response
     */
    public function edit(MailOut $mailOut)
    {
        return view('pages.arsip.mailout.edit', ['mailOut' => $mailOut, 'categories' => MailCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MailOut  $mailOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailOut $mailOut)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'receiver' => ['required', 'string'],
                'title' => ['required', 'string'],
                'category' => ['required', 'exists:mail_categories,id'],
                // 'file' => ['required', 'file', 'mimes:pdf'],                
            ],
            customAttributes: [
                'receiver' => __('attributes.receiver'),
                'title' => __('attributes.title'),
                'category' => __('attributes.category'),
                // 'file' => __('attributes.file'),
            ]
        )->validate();       
                
        if ($request->file('file')) {
            Storage::disk()->delete($mailOut->file);
        }

        $data = [
            'receiver' => $request->receiver,
            'title' => $request->title,
            'mail_category_id' => $request->category,                        
        ];
        if ($request->file('file')) {
            $data['file'] = Storage::put('public/archive/out', $request->file('file'));
        }

        if ($mailOut->update($data)) {            
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('arsip.surat.out.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MailOut  $mailOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailOut $mailOut)
    {
        if ($mailOut->delete()) {
            if ($mailOut->file != '') {
                Storage::disk('public')->delete($mailOut->file);
            }
            $response = array(
                'status' => 'success',
                'message' => 'Surat Keluar berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Surat Keluar tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }   
}
