<?php

namespace App\Http\Controllers\Akademik;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Classes;
use App\Models\Subject;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyJournal;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DailyJournal  $dailyJournal)
    {
        if ($dailyJournal->teacher_id != auth()->user()->teacher->id) {
            Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('akademik.journal.index');
        }
        return view(
            'pages.akademik.task.index',
            [
                'tasks' => Task::where('daily_journal_id', $dailyJournal->id)->get(),
                'dailyJournal' => $dailyJournal
            ]
        );
    }

    public function data(DailyJournal $dailyJournal)
    {
        return DataTables::of(Task::where('daily_journal_id', $dailyJournal->id)->get()->load(
            'dailyJournal',
            'dailyJournal.class',
            'dailyJournal.subject'
        ))            
            ->editColumn('deadline', function ($task) {
                $deadline = Carbon::create($task->deadline);
                return $deadline;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DailyJournal $dailyJournal)
    {
        return view(
            'pages.akademik.task.add',
            [
                'dailyJournal' => $dailyJournal,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DailyJournal $dailyJournal)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'min:3'],
                'deadline' => ['required', 'after:yesterday'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'deadline' => __('attributes.deadline'),
            ],
            messages: [
                'after' => ':attribute harus setelah tanggal hari ini.',
            ]
        )->validate();        

        DB::transaction(function () use ($request, $dailyJournal) {
            $task = Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'daily_journal_id' => $dailyJournal->id,
            ]);

            Student::where('classes_id', $dailyJournal->class_id)->NotAlumni()->get()->load('user')->each(function ($student) use ($task) {
                $student->scores()->create([
                    'task_id' => $task->id,                    
                    'student_id' => $student->id,
                    'value' => 0,
                ]);

                $student->todos()->create([
                    'task_id' => $task->id,
                    'student_id' => $student->id,
                    'status' => false,
                ]);
            });

            if ($task) {
                Alert::toast('Tugas Berhasil ditambahkan pada jurnal.', 'success');
            } else {
                Alert::toast('Tugas gagal ditambahkan.', 'error');
            }
        });
        return redirect()->route('akademik.journal.task.index', ['dailyJournal' => $dailyJournal->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyJournal $dailyJournal, Task $task)
    {
        if ($dailyJournal->teacher_id != auth()->user()->teacher->id) {
            Alert::error('Error', 'Anda tidak memiliki akses');
            return redirect()->back();
        }
        
        return view('pages.akademik.task.edit', [
            'dailyJournal' => $dailyJournal,
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyJournal $dailyJournal, Task $task)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name' => ['required', 'min:3'],
                'deadline' => ['required', 'after:yesterday'],
            ],
            customAttributes: [
                'name' => __('attributes.name'),
                'deadline' => __('attributes.deadline'),
            ],
            messages: [
                'after' => ':attribute harus setelah tanggal hari ini.',
            ]
        )->validate();

        $update = $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        if ($update) {
            Alert::toast('Tugas Berhasil diupdate.', 'success');
        } else {
            Alert::toast('Tugas gagal diupdate.', 'error');
        }

        return redirect()->route('akademik.journal.task.index', ['dailyJournal' => $dailyJournal->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyJournal $dailyJournal, Task $task)
    {
        if ($task->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Tugas berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Tugas tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }
}
