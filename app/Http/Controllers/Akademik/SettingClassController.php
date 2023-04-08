<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SettingClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SettingClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function class()
    {
        return view('pages.akademik.setting_class.class', ['classes' => Classes::with('major')->orderBy('code', 'ASC')->get()->append('siswa', 'mapal'), 'warnanya' => ['success', 'warning', 'danger', 'info', 'secondary']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classes $class)
    {
        $kelas = $class->load('major');
        return view('pages.akademik.setting_class.index', ['kelas' => $kelas, 'teachers' => Teacher::all()->load('user'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Classes $class)
    {
        return view('pages.akademik.setting_class.add', ['kelas' => $class, 'teachers' => Teacher::all()->load('user'), 'subjects' => Subject::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classes $class)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'day' => ['required', 'string', 'max:255'],
                'start_time' => ['required', 'string', 'max:255'],
                'end_time' => ['required', 'string', 'max:255'],
                'pelajaran' => ['required', 'max:2'],                
                'pengajar' => ['required', 'max:50'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'day' => __('attributes.day'),
                'start_time' => __('attributes.start_time'),
                'end_time' => __('attributes.end_time'),
            ],
        )->validate();        

        
        $todayClasses = SettingClass::where('classes_id', $class->id)->where('day', $request->day)->get();
        foreach ($todayClasses as $key => $todayClass) {
            if ($todayClass->start_time <= $request->start_time && $todayClass->end_time > $request->start_time) {
                $error = ValidationException::withMessages([
                    'start_time' => "Waktu mulai kelas tidak boleh berada di tengah-tengah kelas lain",
                ]);
                throw $error;
            }
            if ($todayClass->start_time < $request->end_time && $todayClass->end_time >= $request->end_time) {
                $error = ValidationException::withMessages([
                    'end_time' => "Waktu selesai kelas tidak boleh berada di tengah-tengah kelas lain",
                ]);
                throw $error;
            }
        }

        $insert = SettingClass::create([
            'classes_id' => $class->id,            
            'subject_id' => $request->pelajaran,
            'teacher_id' => $request->pengajar,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('akademik.setting.class.index', ['class' => $class->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingClass  $settingClass
     * @return \Illuminate\Http\Response
     */
    public function show(SettingClass $settingClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingClass  $settingClass
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class, SettingClass $settingClass)
    {
        return view('pages.akademik.setting_class.edit', ['settingClass' => $settingClass,  'kelas' => $class, 'teachers' => Teacher::all()->load('user'), 'subjects' => Subject::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingClass  $settingClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class, SettingClass $settingClass)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'day' => ['required', 'string', 'max:255'],
                'start_time' => ['required', 'string', 'max:255'],
                'end_time' => ['required', 'string', 'max:255'],
                'pelajaran' => ['required', 'max:2'],
                'pengajar' => ['required', 'max:50'],
            ],
            customAttributes: [
                // 'name' => __('attributes.name'),
            ],
        )->validate();        


        $insert = $settingClass->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'classes_id' => $class->id,
            'subject_id' => $request->pelajaran,
            'teacher_id' => $request->pengajar,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data.', 'error');
        }

        return redirect()->to(route('akademik.setting.class.index', ['class' => $class->code]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingClass  $settingClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class, SettingClass $settingClass)
    {
        if ($settingClass->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Mata pelajaran berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Mata pelajaran gagal dihapus!',
            );
        }

        echo json_encode($response);
    }
    public function data(Classes $class)
    {
        // return SettingClass::where('classes_id', $class->id)->get()->load('class', 'teacher');
        return DataTables::of(
            SettingClass::where('classes_id', $class->id)->orderBy('start_time','asc')->get()->append('time')->load('subject', 'teacher.user')
            )->make(true);
    }

    public function update_homeroom(Request $request, Classes $class)
    {
        // dd($class);
        Validator::make(
            data: $request->all(),
            rules: [
                'wali_kelas' => ['required', 'max:2'],
            ],
            customAttributes: [
                'wali_kelas' => __('attributes.wali_kelas'),
            ],
        )->validate();


        $insert = $class->update([
            'teacher_id' => $request->wali_kelas,
        ]);

        if ($insert) {
            Alert::toast('Berhasil Mengubah data Wali Kelas.', 'success');
        } else {
            Alert::toast('Gagal Mengubah data Wali Kelas.', 'error');
        }

        return redirect()->to(route('akademik.setting.class.index', ['class' => $class->code]));
    }
}
