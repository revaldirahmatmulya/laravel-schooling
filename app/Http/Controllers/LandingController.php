<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\News;
use App\Models\SchoolProfile;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Teacher;



class LandingController extends Controller
{


    public function home()
    {
        $profile = SchoolProfile::first();
        $news = News::all();
        $majors = Major::all();
        return view('landing.index', compact('profile', 'news', 'majors'));
    }
    public function profile()
    {
        $profile = SchoolProfile::first();
        $majors = Major::all();
        return view('landing.profile', compact('profile', 'majors'));
    }
    public function teachers()
    {
        $profile = SchoolProfile::first();
        $teachers = Teacher::all();
        $majors = Major::all();

        return view('landing.teachers', compact('teachers', 'profile', 'majors'));
    }
    public function teacher($id, $name)
    {
        $profile = SchoolProfile::first();
        $teacher = Teacher::find($id);
        $majors = Major::all();

        return view('landing.teacher', compact('teacher', 'profile', 'majors'));
    }
    public function staffs()
    {
        $profile = SchoolProfile::first();
        $staff = Staff::all();
        $majors = Major::all();

        return view('landing.staffs', compact('staff', 'profile', 'majors'));
    }
    public function staff($id)
    {
        $profile = SchoolProfile::first();
        $staff = Staff::find($id);
        $majors = Major::all();

        return view('landing.staff', compact('staff', 'profile', 'majors'));
    }
    public function students()
    {
        $profile = SchoolProfile::first();
        $students = Student::all();
        $majors = Major::all();

        return view('landing.students', compact('students', 'profile', 'majors'));
    }
    public function student($id)
    {
        $profile = SchoolProfile::first();
        $students = Student::find($id);
        $majors = Major::all();

        return view('landing.student', compact('students', 'profile', 'majors'));
    }
    public function news()
    {
        $profile = SchoolProfile::first();
        $news = News::all();
        $majors = Major::all();

        return view('landing.news', compact('news', 'profile', 'majors'));
    }
    public function majors()
    {
        $majors = Major::all();
        $profile = SchoolProfile::first();


        return view('landing.majors', compact('majors', 'profile'));
    }
    public function major($id, $name)
    {
        $majors = Major::all();
        $data = Major::find($id);
        $profile = SchoolProfile::first();


        return view('landing.major', compact('majors', 'data', 'profile'));
    }

    public function details($id, $slug)
    {

        $profile = SchoolProfile::first();
        $data = News::find($id);
        $majors = Major::all();

        return view('landing.details', compact('data', 'profile', 'majors'));
    }
}