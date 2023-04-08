<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ItemCategoryController extends Controller
{
    public function index(){        
        return view('pages.sarpras.item.category.index');
    }

    public function data(){
        return DataTables::of(ItemCategory::get())->make(true);
    }

    public function create(){
        return view('pages.sarpras.item.category.add');
    }

    public function store(Request $request){
        Validator::make(
            data: $request->all(),
            rules: [                
                'name' => ['required', 'max:200'],
            ],
            customAttributes: [                
                'name'=> __('attributes.name'),
            ],
        )->validate();

        $insert = ItemCategory::create([
            'name' => $request->name,
        ]);

        if($insert){
            Alert::toast('Data berhasil disimpan', 'success');
        }else{
            Alert::toast('Data gagal disimpan', 'error');
        }

        return redirect()->route('sarpras.item.category.index');
    }

    public function edit(ItemCategory $itemCategory){
        return view('pages.sarpras.item.category.edit', ['itemCategory' => $itemCategory]);
    }

    public function update(Request $request, ItemCategory $itemCategory){
        Validator::make(
            data: $request->all(),
            rules: [                
                'name' => ['required', 'max:200'],
            ],
            customAttributes: [                
                'name'=> __('attributes.name'),
            ],
        )->validate();

        $update = $itemCategory->update([
            'name' => $request->name,
        ]);

        if($update){
            Alert::toast('Data berhasil diubah', 'success');
        }else{
            Alert::toast('Data gagal diubah', 'error');
        }

        return redirect()->route('sarpras.item.category.index');
    }

    public function destroy(ItemCategory $itemCategory){        
        if ($itemCategory->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Barang berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Barang tidak berhasil dihapus!',
            );
        }  

        echo json_encode($response);
    }
}
