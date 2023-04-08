<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\DailyJournal;
use App\Models\Score;
use App\Models\Student;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ScoreController extends Controller
{
    public function index(DailyJournal $dailyJournal, Task $task)
    {        
        if ($dailyJournal->teacher_id != auth()->user()->teacher->id) {
            Alert::error('Error', 'Anda tidak memiliki akses');
            return redirect()->back();
        }

        return view('pages.akademik.score.index', [
            'task' => $task,
            'dailyJournal' => $dailyJournal
        ]);
    }

    public function data(DailyJournal $dailyJournal, Task $task)
    {
        return DataTables::of($task->scores()->with([
            'student',
            'student.user'
        ])
        ->whereHas('student', function($q){
            $q->where('alumni', false);
        })
        ->get())->make(true);
    }

    public function edit(DailyJournal $dailyJournal, Task $task, Score $score)
    {
        if ($dailyJournal->teacher_id != auth()->user()->teacher->id) {
            Alert::error('Error', 'Anda tidak memiliki akses');
            return redirect()->back();
        }

        return view('pages.akademik.score.edit', [
            'score' => $score,
            'task' => $task,
            'dailyJournal' => $dailyJournal
        ]);
    }

    public function update(Request $request, DailyJournal $dailyJournal, Task $task, Score $score)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'value' => ['required', 'numeric', 'min:0', 'max:100']
            ],
            customAttributes: [
                'value' => __('attributes.value')
            ]
        )->validate();

        $update = $score->update([
            'value' => $request->value
        ]);

        $updateTodo = Todo::where('task_id',$task->id)->where('student_id', $score->student_id)->update([
            'status' => true
        ]);

        if ($update && $updateTodo) {
            Alert::toast('Berhasil mengubah nilai', 'success');
        } else {
            Alert::toast('Gagal mengubah nilai', 'error');
        }

        return redirect()->route(
            'akademik.journal.task.score.index',
            [
                'dailyJournal' => $dailyJournal,
                'task' => $task
            ]
        );
    }
}
