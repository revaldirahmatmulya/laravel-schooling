<?php

namespace App\Http\Controllers\Sarpras;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sarpras.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sarpras.supplier.add');
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
                'code' => ['required', 'max:20', Rule::unique(Supplier::class)],
                'name' => ['required', 'max:200'],
                'email' => ['required', 'max:200', 'email'],
                'phone' => ['required', 'max:20', 'regex:/(08)[0-9]/'],
                'address' => ['required'],
            ],
            customAttributes: [
                'code'=> __('attributes.code'),
                'name'=> __('attributes.name'),
                'email'=> __('attributes.email'),
                'phone'=> __('attributes.phone'),
                'address'=> __('attributes.address'), 
            ],
        )->validate();
        

        $insert = Supplier::create([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('sarpras.supplier.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return redirect()->to(route('sarpras.supplier.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('pages.sarpras.supplier.edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'code' => ['required', 'max:20', Rule::unique(Supplier::class)->ignore($supplier->id)],
                'name' => ['required', 'max:200'],
                'email' => ['required', 'max:200'],
                'phone' => ['required', 'max:20'],
                'address' => ['required'],
            ],
            customAttributes: [
                'code'=> __('attributes.code'),
                'name'=> __('attributes.name'),
                'email'=> __('attributes.email'),
                'phone'=> __('attributes.phone'),
                'address'=> __('attributes.address'), 
            ],
        )->validate();


        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($supplier->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('sarpras.supplier.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Pemasok Barang berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pemasok Barang tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }
    public function data()
    {
        return DataTables::of(Supplier::all())->make(true);
    }
}
