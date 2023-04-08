<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\DailyJournal;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DailyJournalController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        return view('pages.akademik.daily_journal.index',['classes' => $classes]);
    }

    public function data()
    {
        return DataTables::of(DailyJournal::where('teacher_id', auth()->user()->teacher->id)
            ->filter(request(['class']))
            ->orderBy('date', 'desc')
            ->get()
            ->load('class', 'subject', 'teacher'))
            ->make(true);
    }

    public function create()
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('pages.akademik.daily_journal.add', [
            'classes' => $classes,
            'subjects' => $subjects,
        ]);
    }

    public function store(Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required', 'min:3'],
                'description' => ['required'],
                'class' => ['required'],
                'subject' => ['required'],
                'journal_date' => ['required', 'date']
            ],
            customAttributes: [
                'title' => __('attributes.title'),
                'description' => __('attributes.description'),
                'class' => __('attributes.class'),
                'subject' => __('attributes.subject'),
                'journal_date' => __('attributes.date')
            ],
        )->validate();

        DB::transaction(function () use ($request) {
            $insert = DailyJournal::create([
                'title' => $request->title,
                'description' => $request->description,
                'class_id' => $request->class,
                'subject_id' => $request->subject,
                'date' => $request->journal_date,
                'teacher_id' => auth()->user()->teacher->id,
            ]);

            Student::where('classes_id', $request->class)->NotAlumni()->get()->each(function ($student) use ($insert) {
                $insert->attendances()->create([
                    'student_id' => $student->id,
                ]);
            });


            if ($insert) {
                Alert::toast('Jurnal berhasil ditambahkan', 'success');
            } else {
                Alert::toast('Jurnal gagal ditambahkan', 'error');
            }
        });

        return redirect()->route('akademik.journal.index');
    }

    public function edit(DailyJournal $dailyJournal)
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('pages.akademik.daily_journal.edit', [
            'classes' => $classes,
            'subjects' => $subjects,
            'journal' => $dailyJournal
        ]);
    }

    public function update(DailyJournal $dailyJournal, Request $request)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required', 'min:3'],
                'description' => ['required'],
                'class' => ['required'],
                'subject' => ['required'],
                'journal_date' => ['required', 'date']
            ],
            customAttributes: [
                'title' => __('attributes.title'),
                'description' => __('attributes.description'),
                'class' => __('attributes.class'),
                'subject' => __('attributes.subject'),
                'journal_date' => __('attributes.date')
            ],
        )->validate();

        DB::transaction(function () use ($request, $dailyJournal) {

            if ($request->class != $dailyJournal->class_id) {
                $dailyJournal->attendances()->delete();
                $dailyJournal->tasks()->delete();

                Student::where('classes_id', $request->class)->NotAlumni()->get()->each(function ($student) use ($dailyJournal) {
                    $dailyJournal->attendances()->create([
                        'student_id' => $student->id,
                    ]);
                });
            }

            $update = $dailyJournal->update([
                'title' => $request->title,
                'description' => $request->description,
                'class_id' => $request->class,
                'subject_id' => $request->subject,
                'date' => $request->journal_date,
                'teacher_id' => auth()->user()->teacher->id,
            ]);


            if ($update) {
                Alert::toast('Jurnal berhasil diubah', 'success');
            } else {
                Alert::toast('Jurnal gagal diubah', 'error');
            }
        });

        return redirect()->route('akademik.journal.index');
    }

    public function destroy(DailyJournal $dailyJournal)
    {
        if ($dailyJournal->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Jurnal berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Jurnal gagal dihapus!',
            );
        }

        echo json_encode($response);
    }
}
