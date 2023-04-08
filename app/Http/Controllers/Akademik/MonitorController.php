<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonitorController extends Controller
{
    public function index()
    {
        return view('pages.akademik.monitor.parents.index');
    }

    public function data()
    {        
        return DataTables::of(Student::latest()->NotAlumni()->where('parent_id', auth()->user()->parent->id)->get()->load('user', 'user.position', 'class'))->make(true);
    }

    public function showStudent(Student $student)
    {
        return view('pages.akademik.monitor.parents.show', [
            'student' => $student
        ]);
    }

    public function showScore(Student $student){
        return view('pages.akademik.monitor.parents.score', [
            'student' => $student
        ]);
    }

    public function dataScore(Student $student){
        return DataTables::of($student->scores()->latest()->get()->load(['task','task.dailyJournal.subject']))->make(true);
    }

    public function showAttendance(Student $student)
    {
        
        $absent = Attendance::where('student_id', $student->id)->where('present', false)->count();
        $present = Attendance::where('student_id', $student->id)->where('present', true)->count();
        return view('pages.akademik.monitor.parents.attendance', [
            'student' => $student,
            'absent' => $absent,
            'present' => $present
        ]);
    }

    public function dataAttendance(Student $student)
    {
        return DataTables::of(Attendance::where('student_id', $student->id)->get()->load('student', 'dailyJournal', 'dailyJournal.subject'))->make(true);
    }
}
