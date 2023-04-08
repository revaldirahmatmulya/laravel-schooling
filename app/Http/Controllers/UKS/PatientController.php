<?php

namespace App\Http\Controllers\UKS;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\PatientDetail;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Patient::all()->load('medicines.medicine');
        return view('pages.uks.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.uks.patient.add', ['medicines' => Medicine::all()]);
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
                'keluhan' => ['required'],
                'penanganan' => ['required'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                // 'obat[]'=> __('attributes.obat'),
            ],
        )->validate();        

        DB::transaction(function () use ($request) {
            $insert = Patient::create([
                'name' => $request->name,
                'complaint' => $request->keluhan,
                'patient_description' => $request->keterangan_pasien,
                'handling' => $request->penanganan,
                'date' => $request->stok_obat,
            ]);
            if ($request->obat) {                
                foreach ($request->obat as $obat) {
                    if ($obat) {                        
                        Medicine::find($obat)->decrement('stock', 1);
                        PatientDetail::create([
                            'patient_id' => $insert->id,
                            'medicine_id' => $obat,
                        ]);
                    }
                }
            }

            if ($insert) {
                Alert::toast('Berhasil menambah data.', 'success');
            } else {
                Alert::toast('Gagal menambah data.', 'error');
            }
        });

        return redirect()->to(route('uks.pasien.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return redirect()->to(route('uks.pasien.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        // return $patient->load('medicines.medicine');
        return view('pages.uks.patient.edit', ['patient' => $patient->load('medicines.medicine'), 'medicines' => Medicine::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'max:200'],
                'keluhan' => ['required'],
                'penanganan' => ['required'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                // 'obat[]'=> __('attributes.obat'),
            ],
        )->validate();

        DB::transaction(function () use($request, $patient) {
            $data = [
                'name' => $request->name,
                'complaint' => $request->keluhan,
                'patient_description' => $request->keterangan_pasien,
                'handling' => $request->penanganan,
                'date' => $request->stok_obat,
            ];
            $new = $request->obat;
            $old = $patient->load('medicines');
            $old = $old->medicines->pluck('medicine_id')->toArray();

            foreach ($new as $n) {
                if (!in_array(strval($n), $old)) {
                    Medicine::find($n)->decrement('stock', 1);
                    PatientDetail::create([
                        'patient_id' => $patient->id,
                        'medicine_id' => $n,
                    ]);
                }
            }
            foreach ($old as $n) {
                if (!in_array(strval($n), $new)) {
                    Medicine::find($n)->increment('stock', 1);
                    PatientDetail::where(['patient_id' => $patient->id, 'medicine_id' => $n])->delete();
                }
            }

            if ($patient->update($data)) {
                Alert::toast('Berhasil mengubah data.', 'success');
            } else {
                Alert::toast('Gagal mengubah data.', 'error');
            }
        });

        return redirect()->to(route('uks.pasien.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        if ($patient->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Pasien berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Pasien tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Patient::orderBy('created_at','desc')->get()->load('medicines.medicine'))->make(true);
    }
}
