<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SettingClass;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentMonitorController extends Controller
{
    public function indexTodo()
    {
        return view('pages.akademik.monitor.student.todo',[
            'student' => auth()->user()->student
        ]);
    }

    public function dataTodo(){
        return DataTables::of(Todo::where('student_id', auth()->user()->student->id)->orderBy('created_at','desc')->get()->load(
            'task',
            'task.dailyJournal',
            'task.dailyJournal.class',
            'task.dailyJournal.subject'
        ))            
            ->editColumn('deadline', function ($todo) {
                $deadline = Carbon::create($todo->task->deadline);
                return $deadline->format('d-m-Y');
            })
            ->editColumn('created_at', function ($todo) {
                $createdAt = Carbon::create($todo->task->created_at);
                return $createdAt->format('d-m-Y');
            })
            ->make(true);
    }

    public function updateTodo(Request $request){
        if (isset($request->id)) {
            $todo = Todo::find($request->id);
            $todo->status = !$todo->status;
            $todo->save();

            $response = array(
                'status' => 'success',
                'message' => 'Todo berhasil diupdate!',
            );
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan!',
            );
        }

        echo json_encode($response);
    }

    public function indexAttendance(){
        $student = auth()->user()->student;
        $absent = Attendance::where('student_id', $student->id)->where('present', false)->count();
        $present = Attendance::where('student_id', $student->id)->where('present', true)->count();
        return view('pages.akademik.monitor.student.attendance', [
            'student' => $student,
            'absent' => $absent,
            'present' => $present
        ]);
    }

    public function dataAttendance(){
        return DataTables::of(Attendance::where('student_id', auth()->user()->student->id)->get()->load('student', 'dailyJournal', 'dailyJournal.subject'))->make(true);
    }

    public function indexScore(){
        return view('pages.akademik.monitor.student.score',[
            'student' => auth()->user()->student
        ]);
    }

    public function dataScore(){
        return DataTables::of(auth()->user()->student->scores()->orderBy('updated_at', 'desc')->get()->load(['task','task.dailyJournal.subject']))->make(true);
    }

    public function indexSchedule(){
        return view('pages.akademik.monitor.student.schedule',[
            'student' => auth()->user()->student
        ]);
    }

    public function dataSchedule(){
        return DataTables::of(SettingClass::where('classes_id', auth()->user()->student->class->id)->get()->append('time')->load('subject', 'teacher', 'teacher.user'))->make(true);
    }
}
