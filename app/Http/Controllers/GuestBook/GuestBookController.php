<?php

namespace App\Http\Controllers\GuestBook;

use App\Models\GuestBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('pages.bukutamu.tamu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.bukutamu.tamu.add');
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
                'email' => ['required', 'max:200', 'email'],
                'phone' => ['required', 'max:200'],
                'date' => ['required', 'max:200'],
                'instance' => ['required', 'max:200'],
                'necessary' => ['required', 'max:200'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                'email'=> __('attributes.email'),
                'phone'=> __('attributes.phone'),
                'date'=> __('attributes.date'), 
                'instance'=> __('attributes.instance'), 
                'necessary'=> __('attributes.necessary'), 
            ],
        )->validate();
        

        $insert = GuestBook::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'instance' => $request->instance,
            'necessary' => $request->necessary,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('tamu.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function show(GuestBook $guestBook)
    {
        return redirect()->to(route('tamu.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function edit(GuestBook $guestBook)
    {
        return view('pages.bukutamu.tamu.edit', ['guestBook' => $guestBook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuestBook $guestBook)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:200'],
                'email' => ['required', 'max:200', 'email'],
                'phone' => ['required', 'max:200'],
                'date' => ['required', 'max:200'],
                'instance' => ['required', 'max:200'],
                'necessary' => ['required', 'max:200'],
            ],
            customAttributes: [
                'name'=> __('attributes.name'),
                'email'=> __('attributes.email'),
                'phone'=> __('attributes.phone'),
                'date'=> __('attributes.date'), 
                'instance'=> __('attributes.instance'), 
                'necessary'=> __('attributes.necessary'), 
            ],
        )->validate();


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'instance' => $request->instance,
            'necessary' => $request->necessary,
        ];

        if ($guestBook->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('tamu.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuestBook  $guestBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuestBook $guestBook)
    {
        if ($guestBook->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Tamu berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Tamu tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(GuestBook::orderBy('created_at','desc')->get())->make(true);
    }
}
