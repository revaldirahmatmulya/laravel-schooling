<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportAttendanceController extends Controller
{
    public function index (){
        $classes = auth()->user()->teacher->classes;        
        return view('pages.akademik.report_attendance.index',
        [
            'classes' => $classes,
            'teacherClass' => $classes->pluck('code')->toArray()
        ]);    
    }

    public function data(string $classCode)
    {
        $class = Classes::where('code', $classCode)->first();
        return DataTables::of(Student::where('classes_id', $class->id)->get()->load('attendances','user'))
        ->addColumn('attend', function ($student) {
            $attend = $student->attendances->where('present', true)->count();
            return $attend;
        })
        ->addColumn('absent', function ($student) {
            $absent = $student->attendances->where('present', false)->count();
            return $absent;
        })
        ->make(true);
    }

    public function show(Student $student)
    {
        $absent = Attendance::where('student_id', $student->id)->where('present', false)->count();
        $present = Attendance::where('student_id', $student->id)->where('present', true)->count();
        return view('pages.akademik.report_attendance.show', [
            'student' => $student,
            'absent' => $absent,
            'present' => $present
        ]);        
    }
    
    public function dataAttendance(Student $student)
    {
        return DataTables::of(Attendance::where('student_id', $student->id)->get()->load('dailyJournal', 'dailyJournal.subject'))->make(true);
    }
}
