<?php

namespace Database\Seeders;

use App\Enums\PositionType;
use App\Models\BookCategory;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Major;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\CategoryItem;
use App\Models\SchoolProfile;
use App\Models\CategorySubject;
use App\Models\ItemCategory;
use App\Models\MailCategory;
use App\Models\Medicine;
use App\Models\NewsCategory;
use App\Models\Parents;
use App\Models\SchoolYear;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            [
                'name' => 'Administrator',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Akademik',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Guru',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Siswa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Alumni',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Orang Tua',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Sarpras',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Keuangan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Perpustakaan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Humas',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Uks',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];
        Position::insert($jabatan);
        $admins = [
            [
                'name' => 'Super Admin',
                'username' => null,
                'position_id' => PositionType::Administrator,
                'email' => 'superadmin@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 1,
                'is_active' => 1,
                'status' => 'root',
                'password' => Hash::make('admin'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Teacher Account',
                'position_id' => PositionType::Teacher,
                'username' => 'teacher',
                'email' => 'teacher@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Student Account',
                'position_id' => PositionType::Student,
                'username' => 'student',
                'email' => 'student@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Alumni Account',
                'position_id' => PositionType::Alumni,
                'username' => 'alumni',
                'email' => 'alumni@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Parents Account',
                'position_id' => PositionType::Parents,
                'username' => 'parents',
                'email' => 'parents@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Akademik Account',
                'position_id' => PositionType::StaffAkademik,
                'username' => 'staff_akademik',
                'email' => 'staff_akademik@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Sarpras Account',
                'position_id' => PositionType::StaffSarpras,
                'username' => 'staff_sarpras',
                'email' => 'staff_sarpras@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Keuangan Account',
                'position_id' => PositionType::StaffKeuangan,
                'username' => 'staff_keuangan',
                'email' => 'staff_keuangan@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Perpustakaan Account',
                'position_id' => PositionType::StaffPerpustakaan,
                'username' => 'staff_perpustakaan',
                'email' => 'staff_perpustakaan@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Humas Account',
                'position_id' => PositionType::StaffHumas,
                'username' => 'staff_humas',
                'email' => 'staff_humas@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Staff Uks Account',
                'position_id' => PositionType::StaffUks,
                'username' => 'staff_uks',
                'email' => 'staff_uks@mail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin' => 0,
                'is_active' => 1,
                'status' => 'user',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ];

        User::insert($admins);
        $teacher = [
            [
                'nip' => '000001',
                'user_id' => 2,
                'gender' => 'Laki-Laki',
                'birthdate' => '2000-05-11',
                'birthplace' => 'Konoha',
                'phone' => '085624624663',
                'address' => 'Konoha',
                'religion' => 'islam',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Teacher::insert($teacher);


        $kategorimapel = [
            [
                'name' => 'UMUM',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'KHUSUS',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        CategorySubject::insert($kategorimapel);

        $major = [
            [
                'code' => 'RPL',
                'name' => 'Rekayasa Perangkat Lunak',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Major::insert($major);

        $classess = [
            [
                'name' => 'A',
                'code' => 'a-rpl',
                'major_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Classes::insert($classess);

        $students = [
            [
                'nis' => '010101',
                'nisn' => '101010',
                'user_id' => 3,
                'classes_id' => 1,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Rumah sakit',
                'phone' => '081234567',
                'address' => 'di rumah',
                'religion' => 'islam',
                'generation' => '2018',
                'alumni' => false,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Student::insert($students);

        $parent = [
            [
                'user_id' => 5,
                'phone' => '081234567',
                'address' => 'di rumah',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Parents::insert($parent);
        $staff = [
            [
                'user_id' => 6,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
            [
                'user_id' => 7,
                'gender' => 'Laki-laki',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
            [
                'user_id' => 8,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
            [
                'user_id' => 9,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
            [
                'user_id' => 10,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
            [
                'user_id' => 11,
                'gender' => 'Perempuan',
                'birthdate' => '2001-06-20',
                'birthplace' => 'Di bidan',
                'phone' => '081234567',
                'address' => 'ga punya rumah',
                'religion' => 'islam',
            ],
        ];

        Staff::insert($staff);

        $mapel = [
            [
                'name' => 'Bahasa Indonesia',
                'code' => 'B Indo',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bahasa Inggris',
                'code' => 'B Ing',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Matematika',
                'code' => 'MTK',
                'category_subject_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Subject::insert($mapel);

        $news_category = [
            [
                'name' => 'Berita',
                'slug' => 'berita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        NewsCategory::insert($news_category);

        SchoolProfile::create([
            'name' => 'Pondok Pesantren Sabiilul Hidaayah',
            'address' => 'Jl. Tlk. Pelabuhan Ratu No.37F, Arjosari, Kec. Blimbing, Kota Malang, Jawa Timur 65126',
            'whatsapp' => '0813-3477-0733',
            'email' => 'ponpes_sabiilulhidaayah@gmail.com',
            'website' => 'https://ponpes-sabiilulhidaayah.sch.id',
        ]);

        $item_categories = [
            [
                'name' => 'Peralatan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Furnitur',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Peralatan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Peralatan Olahraga',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        ItemCategory::insert($item_categories);

        $suppliers = [
            [
                'code' => 'SUP-001',
                'name' => 'PT. Maju Jaya',
                'address' => 'Jl. Tlk. Pelabuhan Ratu No.37F, Arjosari, Kec. Blimbing, Kota Malang, Jawa Timur 65126',
                'phone' => '0813-3477-0733',
                'email' => 'majujaya@mail.com'
            ],
        ];

        Supplier::insert($suppliers);

        $mail_categories = [
            [
                'name' => 'Penting',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Biasa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Segera',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        MailCategory::insert($mail_categories);

        $book_categories = [
            [
                'name' => 'Agama',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sains',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bahasa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Matematika',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],        
        ];

        BookCategory::insert($book_categories);
    }
}
