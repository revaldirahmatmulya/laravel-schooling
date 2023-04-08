<?php

namespace App\Http\Controllers\Sarpras;

use App\Models\Item;
use App\Models\CategoryItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sarpras.item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        if (ItemCategory::count() == 0) {
            Alert::toast('Silahkan tambahkan kategori terlebih dahulu', 'error');
            return redirect()->route('sarpras.item.category.index');
        }
        return view('pages.sarpras.item.add', ['categories' => ItemCategory::all()]);
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
                'code' => ['required', 'max:200', Rule::unique(Item::class)],
                'name' => ['required', 'max:200'],
                'category' => ['required', 'max:2'],
                'unit' => ['required', 'max:200'],
                // 'amount' => ['required', 'max:200'],
            ],
            customAttributes: [
                'code'=> __('attributes.code'),
                'name'=> __('attributes.name'),
                'category'=> __('attributes.category'),
                'unit'=> __('attributes.unit'),
                // 'amount'=> __('attributes.amount'), 
            ],
        )->validate();
        

        $insert = Item::create([
            'code' => $request->code,
            'name' => $request->name,
            'item_category_id' => $request->category,
            'unit' => $request->unit,
            'amount' => 0,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('sarpras.item.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return redirect()->to(route('sarpras.item.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('pages.sarpras.item.edit', ['item' => $item->load('category'), 'categories' => ItemCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'code' => ['required', 'max:200', Rule::unique(Item::class)->ignore($item->id)],
                'name' => ['required', 'max:200'],
                'category' => ['required', 'max:2'],
                'unit' => ['required', 'max:200'],
                // 'amount' => ['required', 'max:200'],
            ],
            customAttributes: [
                'code'=> __('attributes.code'),
                'name'=> __('attributes.name'),
                'category'=> __('attributes.category'),
                'unit'=> __('attributes.unit'),
                // 'amount'=> __('attributes.amount'), 
            ],
        )->validate();


        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'item_category_id' => $request->category,
            'unit' => $request->unit,
            'amount' => 0,
        ];

        if ($item->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('sarpras.item.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if ($item->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Barang berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Barang tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Item::all()->load('category'))->make(true);
    }
}
