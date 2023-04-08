<?php

namespace Database\Seeders;

use App\Enums\PositionType;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\DailyJournal;
use App\Models\Major;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userForTeacher = User::create([
            'name' => 'Teacher2',
            'email' => 'teacher2@mail.com',
            'position_id' => PositionType::Teacher,
            'username' => 'teacher2',
            'password' => bcrypt('password'),
            'is_admin' => 0,
            'is_active' => 1,
            'status' => 'user',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $teacherAgain = Teacher::create([
            'nip' => '000002',
            'user_id' => $userForTeacher->id,
            'gender' => 'Perempuan',
            'birthdate' => '1982-07-03',
            'birthplace' => 'Jakarta',
            'phone' => '082394322',
            'address' => 'Jakarta',
            'religion' => 'hindu',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $majors = [
            [
                'id' => 2,
                'name' => 'IPA',
                'code' => 'IPA',
                'status' => 1,
            ],
            [
                'id' => 3,
                'name' => 'IPS',
                'code' => 'IPS',
                'status' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Bahasa',
                'code' => 'BHS',
                'status' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Matematika',
                'code' => 'MTK',
                'status' => 1,
            ]
        ];

        Major::insert($majors);

        $levels = ['X', 'XI', 'XII'];
        $alphabets = ['A', 'B'];

        foreach ($majors as $major) {
            foreach ($levels as $level) {
                foreach ($alphabets as $alphabet) {
                    Classes::create([
                        'name' => $level . " " . $alphabet,
                        'code' => $level . $alphabet . "-" . $major['code'],
                        'major_id' => $major['id'],
                        'teacher_id' => Teacher::factory()->create()->id,
                        'status' => true
                    ]);
                }
            }
        }

        Classes::all()->each(function ($class) {
            for ($i = 0; $i < 15; $i++) {
                Student::factory()->create([
                    'classes_id' => $class->id,
                ]);
            }
        });

        $subjects = [
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'B.IND',
                'category_subject_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Bahasa Inggris',
                'code' => 'B.ING',
                'category_subject_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Matematika',
                'code' => 'MTK',
                'category_subject_id' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Fisika',
                'code' => 'FIS',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Kimia',
                'code' => 'KIM',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Biologi',
                'code' => 'BIO',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Sejarah',
                'code' => 'SEJ',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Geografi',
                'code' => 'GEO',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Ekonomi',
                'code' => 'EKO',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Sosiologi',
                'code' => 'SOS',
                'category_subject_id' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Seni Budaya',
                'code' => 'SB',
                'category_subject_id' => 2,
                'status' => 1,
            ]
        ];

        Subject::insert($subjects);

        Classes::all()->each(function ($class) {
            DailyJournal::factory([
                'class_id' => $class->id,
            ])->count(5)->create();
        });

        DailyJournal::all()->each(function ($dailyJournal) {            

            Student::where('classes_id', $dailyJournal->class_id)->get()->each(function ($student) use ($dailyJournal) {                
                $dailyJournal->tasks->each(function ($task) use ($student) {
                    Todo::create([
                        'task_id' => $task->id,
                        'student_id' => $student->id,
                        'status' => true,
                    ]);
                    Score::create([
                        'task_id' => $task->id,
                        'student_id' => $student->id,
                        'value' => rand(1, 100),
                    ]);
                });
                
                Attendance::factory()->create([
                    'daily_journal_id' => $dailyJournal->id,
                    'student_id' => $student->id,
                ]);
            });
        });

        
    }
}
