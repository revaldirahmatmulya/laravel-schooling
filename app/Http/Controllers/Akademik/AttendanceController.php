<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DailyJournal;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index(DailyJournal $dailyJournal)
    {        
        return view('pages.akademik.attendance.index',[
            'dailyJournal' => $dailyJournal,
        ]);
    }

    public function data(DailyJournal $dailyJournal){
        return DataTables::of($dailyJournal->attendances()->with([
            'student',
            'student.user',
        ])
        ->whereHas('student', function($q){
            $q->where('alumni', false);
        })
        ->get())->make(true);
    }

    public function store(Request $request,DailyJournal $dailyJournal)
    {       
        if ($request->presents == null) {
            $dailyJournal->attendances()->update([
                'present' => false
            ]);

            Alert::success('success', 'Data presensi berhasil disimpan');

            return redirect()->route('akademik.journal.attendance.index',$dailyJournal->id);                        
        }
        
        $dailyJournal->attendances()->update([
            'present' => false
        ]);
        
       $dailyJournal->attendances()->whereIn('student_id',$request->presents)->update([
            'present' => true
        ]);

        Alert::success('success', 'Data presensi berhasil disimpan');

        return redirect()->route('akademik.journal.attendance.index',$dailyJournal->id);


    }
}
