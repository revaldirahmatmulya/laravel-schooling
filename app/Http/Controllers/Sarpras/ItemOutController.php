<?php

namespace App\Http\Controllers\Sarpras;

use App\Models\Item;
use App\Models\ItemOut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ItemOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sarpras.item.out.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sarpras.item.out.add', ['items' => Item::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['item' => ['required', 'max:2']],
        );

        $request->merge(['current_amount' => Item::find($request->item)->amount]);        

        Validator::make(
            data: $request->all(),
            rules: [                
                'amount' => ['required', 'numeric', 'lte:current_amount'],
                'description' => ['required'],
                'date_out' => ['required'],
            ],
            customAttributes: [                
                'amount' => __('attributes.amount'),
                'description' => __('attributes.description'),
                'date_out' => __('attributes.date_out'),
            ],
            messages: [
                'lte' => "Jumlah barang yang diambil tidak boleh melebihi jumlah barang yang tersedia",
            ],
        )->validate();

        // dd($request->all());


        $insert = ItemOut::create([
            'item_id' => $request->item,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date_out,
        ]);

        $amount = false;

        if ($insert) {
            $item = Item::find($request->item);
            $amount = (int) $item->amount - (int) $request->amount;
            $amount = $item->update(['amount' => $amount]);
        }

        if ($insert && $amount) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('sarpras.item.out.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function show(ItemOut $itemOut)
    {
        return redirect()->to(route('sarpras.item.out.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemOut $itemOut)
    {
        return view('pages.sarpras.item.out.edit', ['itemOut' => $itemOut, 'items' => Item::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemOut $itemOut)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'amount' => ['required', 'max:200', 'numeric'],
                'description' => ['required'],
                'date_out' => ['required', 'max:200'],
            ],
            customAttributes: [
                'amount' => __('attributes.amount'),
                'description' => __('attributes.description'),
                'date_out' => __('attributes.date_out'),
            ],
        )->validate();

        $data = [
            // 'code' => $request->code,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date_out,
        ];
        $item = Item::find($itemOut->item_id);
        $amount = (int) $item->amount + (int)$itemOut->amount;
        $amount = (int) $amount - (int) $request->amount;
        $item->update(['amount' => $amount]);

        if ($itemOut->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        } else {
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('sarpras.item.out.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemOut $itemOut)
    {
        if ($itemOut->delete()) {

            $item = Item::find($itemOut->item_id);
            $amount = (int) $item->amount - (int) $itemOut->amount;
            $amount = $item->update(['amount' => $amount]);
            // return $itemIn;

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
        return DataTables::of(ItemOut::all()->load('item')->append('tanggal'))->make(true);
    }
}
