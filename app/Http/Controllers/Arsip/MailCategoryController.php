<?php

namespace App\Http\Controllers\Arsip;

use App\Models\MailCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MailCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.arsip.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.arsip.category.add');
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
                'name' => ['required', 'max:200'],
            ],
            customAttributes: [
                'name'=> __('attributes.name_id'),
            ],
        )->validate();
        

        $insert = MailCategory::create([
            'name' => $request->name,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('arsip.surat.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MailCategory  $mailCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MailCategory $mailCategory)
    {
        return redirect()->to(route('arsip.surat.category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MailCategory  $mailCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MailCategory $mailCategory)
    {
        return view('pages.arsip.category.edit', ['mailCategory' => $mailCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MailCategory  $mailCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailCategory $mailCategory)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:200'],
            ],
        )->validate();


        $data = [
            'name' => $request->name,
        ];

        if ($mailCategory->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('arsip.surat.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MailCategory  $mailCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailCategory $mailCategory)
    {
        if ($mailCategory->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Surat berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Surat tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(MailCategory::all())->make(true);
    }
}
