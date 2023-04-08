<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\UksOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Enums\PositionType;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\DailyJournal;
use App\Models\GuestBook;
use App\Models\Item;
use App\Models\Parents;
use App\Models\Position;
use App\Models\Procurement;
use App\Models\Room;
use App\Models\Score;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Book;
use App\Models\Rental;
use App\Models\Todo;


class DashboardController extends Controller
{
    public function index()
    {
        // Akademik
        if (auth()->user()->position_id == PositionType::StaffAkademik){
            $studentsCount = Student::count();
            $teachersCount = Teacher::count();
            $majorsCount = Major::count();
            $subjectsCount = Subject::count();
            $alumnusCount = DB::table('students')
                ->where('alumni', 1)->count();
            // student per class
            //datasets
            $studentsClasses =
                DB::table('students')
                ->selectRaw('count(id) as result')
                ->groupBy('classes_id')->pluck('result');

            $studentsClassesGroup = [];
            foreach ($studentsClasses as $item) {
                $studentsClassesGroup[] = $item;
            }

            //labels
            $classes =
                Classes::select('code')
                ->pluck('code');
            $classesList = [];
            foreach ($classes as $item) {
                $classesList[] = $item;
            }


            // student per major
            $majorsList = Major::select('code')->pluck('code');
            $students = Student::with('class.major')->get()->toArray();
            
            $studentsMajors = Major::with('classes', 'classes.students')->get()->each(function ($major) {
                $major->total = $major->classes->sum(function ($class) {
                    return $class->students()->count();
                });
            });                        

            $studentsMajorsGroup = Major::with('classes', 'classes.students')->get()->each(function ($major) {
                $major->total = $major->classes->sum(function ($class) {
                    return $class->students()->NotAlumni()->count();
                });
            })->pluck('total','name');            


            return view('index',compact('studentsCount','teachersCount','majorsCount','subjectsCount','alumnusCount','studentsClassesGroup','classesList','majorsList','students', 'studentsMajorsGroup'));
        } else {
            $studentsCount = Student::count();
            $teachersCount = Teacher::count();
            $majorsCount = Major::count();
            $subjectsCount = Subject::count();
            $alumnusCount = DB::table('students')
                ->where('alumni', 1)->count();
            // student per class
            //datasets
            $studentsClasses =
                DB::table('students')
                ->selectRaw('count(id) as result')
                ->groupBy('classes_id')->pluck('result');

            $studentsClassesGroup = [];
            foreach ($studentsClasses as $item) {
                $studentsClassesGroup[] = $item;
            }

            //labels
            $classes =
                Classes::select('code')
                ->pluck('code');
            $classesList = [];
            foreach ($classes as $item) {
                $classesList[] = $item;
            }


            // student per major
            $majorsList = Major::select('code')->pluck('code');
            $students = Student::with('class.major')->get()->toArray();
            
            $studentsMajors = Major::with('classes', 'classes.students')->get()->each(function ($major) {
                $major->total = $major->classes->sum(function ($class) {
                    return $class->students()->count();
                });
            });           
            
            $studentsMajorsGroup = Major::with('classes', 'classes.students')->get()->each(function ($major) {
                $major->total = $major->classes->sum(function ($class) {
                    return $class->students()->NotAlumni()->count();
                });
            })->pluck('total','name');  
        }
        // Student
        if (auth()->user()->position_id == PositionType::Student) {
            $studentID = auth()->user()->student->id;
            $class = auth()->user()->student->class->name;
            $classID = auth()->user()->student->class->id;
            $classJournalID = DailyJournal::select('id')->where('class_id', '=', $classID)->pluck('id');
            $taskNew = Todo::where('status','=',0)->where('student_id','=',$studentID)->take(5)->get()->reverse();


            $taskName = [];
            $taskDescription = [];
            foreach($taskNew as $item){
                $taskName[]=$item->task->name;
                $taskDescription[]=$item->task->description;
            }
            $taskNameScores=[];
            foreach ($classJournalID as $item) {
                $task = Task::where('daily_journal_id', '=', $item)->take(10)->get();
                foreach ($task as $each) {
                    $taskNameScores[] = $each->name;
                    
                }
            }
            

            $name = auth()->user()->student->user->name;
            $nisn = auth()->user()->student->nisn;
            $major = auth()->user()->student->class->major->code;
            
            $scores = Score::select('value')->where('student_id', '=', $studentID)->take(10)->pluck('value');
            $scoresValue = [];
            foreach ($scores as $item) {
                $scoresValue[] = $item;
            }

            return view('index', compact('class', 'name', 'nisn', 'major', 'classJournalID', 'taskDescription', 'scoresValue', 'taskName','taskNameScores'));
        }
        // Teacher
        if (auth()->user()->position_id == PositionType::Teacher) {
            
            $teacherName = auth()->user()->teacher->user->name;
            $teacherNIP = auth()->user()->teacher->nip;
            $teacherPhone = auth()->user()->teacher->phone;
            $teacherAddress = auth()->user()->teacher->address;
            $teacherID = auth()->user()->teacher->id;
            $classID = Classes::select('id')->where('teacher_id', '=', $teacherID)->pluck('id');
            $classIDConvert = [];
            foreach ($classID as $item) {
                $classIDConvert[] = $item;
            }
            $students = Student::where('classes_id', '=', $classIDConvert)->get();


            
            $classJournalID = DailyJournal::select('id')->where('teacher_id', '=', $teacherID)->get()->pluck('id');
            
            
            $taskName = [];
            $taskDescription = [];
            foreach ($classJournalID as $item) {
                $taskID = Task::where('daily_journal_id', '=', $item)->take(5)->get()->reverse();
                foreach ($taskID as $each) {
                   
                        $taskName[]=$each->name;
                        $taskDescription[]=$each->description;
                  
                }
            }
            
          

            return view('index', compact('students', 'classID', 'teacherID', 'classIDConvert', 'classJournalID', 'teacherNIP', 'taskName', 'taskDescription', 'teacherPhone', 'teacherAddress', 'teacherName'));
        }
        // Parents
        if (auth()->user()->position_id == PositionType::Parents) {
            $parentID = auth()->user()->parent->id;
            $student = Student::where('parent_id', '=', $parentID)->get();
             
            $studentEachID=Student::select('id')->where('parent_id', '=', $parentID)->get()->pluck('id');
            $eachID=[];
            foreach ($studentEachID as $item) {
                $eachID[]=$item;
            }

            $countStudentsInClass=[];
            foreach($student as $item){
                 $countStudent = DB::table('students')
                ->selectRaw('count(id) as result')
                ->where('classes_id','=',$item->class->id)
                ->groupBy('classes_id')->pluck('result');
                 $countStudentsInClass[]=$countStudent;
            }
            
    
            $taskName = [];
            $eachName=[];
            foreach($student as $item){
                $classJournalID = DailyJournal::select('id')->where('class_id', '=', $item->classes_id)->pluck('id');
                foreach ($classJournalID as $item) {
                    $task = Task::where('daily_journal_id', '=', $item)->take(10)->get();
                    foreach ($task as $each) {
                        $taskName[] = $each->name;
                    }
                   
                }
                 $eachName[]=$taskName;
                $taskName=null;
                
            }
            
            $scoresValue = [];
            $eachScore=[];
            foreach($student as $item){
                $scores = Score::select('value')->where('student_id', '=', $item->id)->take(10)->pluck('value');
                    foreach ($scores as $item) {
                    $scoresValue[] = $item;
                }
                $eachScore[]=$scoresValue;
                $scoresValue=null;
            }
            $eachDay=[];
            foreach($student as $item){
                $present0 = Attendance::select('id')->where('student_id', '=', $item->id)->Where('present', '=', 0)->get()->pluck('id')->count();
                $present1 = Attendance::select('id')->where('student_id', '=', $item->id)->Where('present', '=', 1)->get()->pluck('id')->count();
                $presentMerged =[$present0,$present1];
                $eachDay[] = $presentMerged;
                $presentMerged=null;
            }

            return view('index', compact('student', 'parentID','eachName','eachScore','eachDay','eachID','countStudentsInClass'));
        }
        // Perpus
        if(auth()->user()->position_id == PositionType::StaffPerpustakaan){
            $today = date_create()->format('Y-m-d H:i:s');
            $books =Book::count();
            $late = Rental::where('return_date','<',$today)->where('status','=','ongoing')->take(5)->get()->reverse();
           
            $rentalDay =  Rental::select('id', 'created_at')->take(7)->get()->groupBy(function ($rentalDay) {
            return Carbon::parse($rentalDay->created_at)->format('D');
            });
                $Days4 = [];
                $rentalDayCount = [];
                foreach ($rentalDay as $day4 => $values) {
                    $Days4[] = $day4;
                    $rentalDayCount[] = count($values);
                }
              

                return view('index',compact('books','late','Days4','rentalDayCount'));
        } else {
            $today = date_create()->format('Y-m-d H:i:s');
            $books =Book::count();
            $late = Rental::where('return_date','<',$today)->where('status','=','ongoing')->take(5)->get()->reverse();
            
            $rentalDay =  Rental::select('id', 'created_at')->take(7)->get()->groupBy(function ($rentalDay) {
            return Carbon::parse($rentalDay->created_at)->format('D');
            });
                $Days4 = [];
                $rentalDayCount = [];
                foreach ($rentalDay as $day4 => $values) {
                    $Days4[] = $day4;
                    $rentalDayCount[] = count($values);
                }
        }
        // UKS
        if(auth()->user()->position_id == PositionType::StaffUks){
            $drugsCount = Medicine::count();
            $uksOfficers = UksOfficer::count();
            //UKS per day
            $uksDay =  Patient::select('id', 'created_at')->take(7)->get()->groupBy(function ($uksDay) {
                return Carbon::parse($uksDay->created_at)->format('D');
            });
            $Days1 = [];
            $uksDayCount = [];
            foreach ($uksDay as $day1 => $values) {
                $Days1[] = $day1;
                $uksDayCount[] = count($values);
            }
            return view ('index',compact('drugsCount','uksOfficers','Days1','uksDayCount'));
            
        } else {
             $drugsCount = Medicine::count();
            $uksOfficers = UksOfficer::count();
            //UKS per day
            $uksDay =  Patient::select('id', 'created_at')->take(7)->get()->groupBy(function ($uksDay) {
                return Carbon::parse($uksDay->created_at)->format('D');
            });
            $Days1 = [];
            $uksDayCount = [];
            foreach ($uksDay as $day1 => $values) {
                $Days1[] = $day1;
                $uksDayCount[] = count($values);
            }
        }
         // Sarpras
        if(auth()->user()->position_id == PositionType::StaffSarpras){
           
            $itemsCount = Item::count();
            $roomsCount = Room::select('name')->pluck('name')->count();
        


            $procurementsPerDay = Procurement::select('id', 'created_at')->take(7)->get()->groupBy(function ($procurementsPerDay) {
                return Carbon::parse($procurementsPerDay->created_at)->format('D');
            });
            $Days2 = [];
            $procurementsDayCount = [];
            foreach ($procurementsPerDay as $day2 => $values) {
                $Days2[] = $day2;
                $procurementsDayCount[] = count($values);
            }
            return view('index',compact('itemsCount','roomsCount','procurementsDayCount','Days2'));
            
        } else {
            $itemsCount = Item::count();
            $roomsCount = Room::select('name')->pluck('name')->count();
        


            $procurementsPerDay = Procurement::select('id', 'created_at')->take(7)->get()->groupBy(function ($procurementsPerDay) {
                return Carbon::parse($procurementsPerDay->created_at)->format('D');
            });
            $Days2 = [];
            $procurementsDayCount = [];
            foreach ($procurementsPerDay as $day2 => $values) {
                $Days2[] = $day2;
                $procurementsDayCount[] = count($values);
            }
        }
        // Humas
        if(auth()->user()->position_id == PositionType::StaffHumas){
            $guestCount = GuestBook::count();
            $guestPerDay = GuestBook::select('id', 'date')->take(7)->get()->groupBy(function ($guestPerDay) {
                return Carbon::parse($guestPerDay->date)->format('D');
            });
            $Days3 = [];
            $guestDayCount = [];
            foreach ($guestPerDay as $day3 => $values) {
                $Days3[] = $day3;
                $guestDayCount[] = count($values);
            }
            return view('index',compact('guestCount','guestDayCount','Days3')); 

        } else {
            $guestCount = GuestBook::count();
            $guestPerDay = GuestBook::select('id', 'date')->take(3)->get()->groupBy(function ($guestPerDay) {
                return Carbon::parse($guestPerDay->date)->format('D');
            });
            $Days3 = [];
            $guestDayCount = [];
            foreach ($guestPerDay as $day3 => $values) {
                $Days3[] = $day3;
                $guestDayCount[] = count($values);
            }
        }

        return view('index', compact('studentsCount', 'teachersCount', 'majorsCount', 'subjectsCount', 'alumnusCount', 'drugsCount', 'uksOfficers', 'Days1', 'uksDayCount', 'studentsClassesGroup', 'classesList', 'majorsList', 'students', 'Days2', 'procurementsDayCount', 'itemsCount', 'roomsCount', 'guestCount', 'Days3', 'guestDayCount', 'studentsMajors','books','late','Days4','rentalDayCount', 'studentsMajorsGroup'));
    }
}