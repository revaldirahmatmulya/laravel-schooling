<?php

namespace App\Http\Controllers\UKS;

use Schema;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Schema::getColumnListing((new User)->getTable());
        // return $user;
        return view('pages.uks.medicine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.uks.medicine.add');
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
                'description' => ['required', 'max:200'],
                'stok_obat' => ['required', 'max:20'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                'description'=> __('attributes.description'),
            ],
        )->validate();
        

        $insert = Medicine::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stok_obat,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('uks.obat.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        return redirect()->to(route('uks.obat.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        return view('pages.uks.medicine.edit', ['medicine' => $medicine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:200'],
                'description' => ['required', 'max:200'],
                'stok_obat' => ['required', 'max:20'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                'description'=> __('attributes.description'),
            ],
        )->validate();


        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stok_obat,
        ];

        if ($medicine->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('uks.obat.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        if ($medicine->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Obat berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Obat tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Medicine::all())->make(true);
    }
}
