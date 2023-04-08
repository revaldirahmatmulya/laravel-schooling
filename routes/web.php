<?php

use App\Models\Book;
use App\Models\News;
use App\Models\Task;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Major;
use App\Models\Score;
use App\Models\Staff;
use App\Mail\CobaMail;
use App\Models\Author;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Position;
use App\Models\BookCategory;
use App\Models\DailyJournal;
use App\Models\ItemCategory;
use App\Models\NewsCategory;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AccessKeyController;
use App\Http\Controllers\Master\NewsController;
use App\Http\Controllers\UKS\PatientController;
use App\Http\Controllers\Arsip\MailInController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\Master\AdminController;
use App\Http\Controllers\Master\StaffController;
use App\Http\Controllers\Sarpras\ItemController;
use App\Http\Controllers\Sarpras\RoomController;
use App\Http\Controllers\UKS\MedicineController;
use App\Http\Controllers\Akademik\TaskController;
use App\Http\Controllers\Arsip\MailOutController;
use App\Http\Controllers\BorrowingFineController;
use App\Http\Controllers\Master\AlumniController;
use App\Http\Controllers\Akademik\MajorController;
use App\Http\Controllers\Akademik\ScoreController;
use App\Http\Controllers\Arsip\ReportInController;
use App\Http\Controllers\Master\ParentsController;
use App\Http\Controllers\Master\StudentController;
use App\Http\Controllers\Master\TeacherController;
use App\Http\Controllers\Sarpras\ReportController;
use App\Http\Controllers\UKS\UksOfficerController;
use App\Http\Controllers\Arsip\ReportOutController;
use App\Http\Controllers\Master\PositionController;
use App\Http\Controllers\Sarpras\ItemOutController;
use App\Http\Controllers\Akademik\ClassesController;
use App\Http\Controllers\Akademik\SubjectController;
use App\Http\Controllers\Sarpras\SupplierController;
use App\Http\Controllers\Arsip\DispositionController;
use App\Http\Controllers\Arsip\MailCategoryController;
use App\Http\Controllers\Finance\SubmissionController;
use App\Http\Controllers\Akademik\AttendanceController;
use App\Http\Controllers\Akademik\SchoolYearController;
use App\Http\Controllers\GuestBook\GuestBookController;
use App\Http\Controllers\Master\NewsCategoryController;
use App\Http\Controllers\Sarpras\ProcurementController;
use App\Http\Controllers\Master\SchoolProfileController;
use App\Http\Controllers\Sarpras\CategoryItemController;
use App\Http\Controllers\Sarpras\ItemCategoryController;
use App\Http\Controllers\Akademik\DailyJournalController;
use App\Http\Controllers\Akademik\SettingClassController;
use App\Http\Controllers\Akademik\ClassPromotionController;
use App\Http\Controllers\Akademik\CategorySubjectController;
use App\Http\Controllers\GuestBook\GuestBookReportController;
use App\Http\Controllers\Akademik\AdminController as AkademikAdmin;
use App\Http\Controllers\Akademik\AlumniController as AkademikAlumni;
use App\Http\Controllers\Akademik\MonitorController as AkademikMonitor;
use App\Http\Controllers\Akademik\ParentsController as AkademikParents;
use App\Http\Controllers\Akademik\ReportAttendanceController;
use App\Http\Controllers\Akademik\StudentController as AkademikStudent;
use App\Http\Controllers\Akademik\TeacherController as AkademikTeacher;
use App\Http\Controllers\Akademik\StudentMonitorController as AkademikStudentMonitor;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//webpages
route::get('/home', [LandingController::class, 'home'])->name('home');
route::get('/profile', [LandingController::class, 'profile'])->name('home.profile');
route::get('/teachers', [LandingController::class, 'teachers'])->name('home.teacher');
route::get('/teacher/{id}/{name}', [LandingController::class, 'teacher'])->name('home.teacher.detail');
route::get('/staffs', [LandingController::class, 'staffs'])->name('home.staff');
route::get('/staff/{id}', [LandingController::class, 'staff'])->name('home.staff.detail');
route::get('/students', [LandingController::class, 'students'])->name('home.student');
route::get('/student/{id}', [LandingController::class, 'student'])->name('home.student.detail');
route::get('/news', [LandingController::class, 'news'])->name('home.news');
route::get('/contact', [LandingController::class, 'contact'])->name('home.contact');
route::get('/majors', [LandingController::class, 'majors'])->name('home.major');
route::get('/major/{id}/{name}', [LandingController::class, 'major'])->name('home.major.detail');
route::get('/news/details/{id}/{slug}', [LandingController::class, 'details'])->name('home.news.details');

//end

Route::get('/', function () {
    return redirect()->route('master.dashboard');
});

// must login
Route::middleware(['auth'])->group(function () {
    Route::get('/edit/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/edit/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::prefix('master')->group(function () {
        Route::name('master.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

            Route::middleware(['administrator'])->group(function () {
                Route::group(['prefix' => 'access_key', 'controller' => AccessKeyController::class], function () {
                    Route::name('accesskey.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{apiUser}', 'update')->name('update');
                        Route::get('/detail/{apiUser}', 'show')->name('detail');
                        Route::get('/edit/{apiUser}', 'edit')->name('edit');
                        Route::delete('/{apiUser}', 'destroy')->name('delete');
                    });
                });
                // Route::group(['prefix' => 'jabatan', 'controller' => PositionController::class], function () {
                //     Route::name('jabatan.')->group(function () {
                //         Route::get('', 'index')->name('index');
                //         Route::post('', 'store')->name('store');
                //         Route::get('/add', 'create')->name('add');
                //         Route::put('/{position}', 'update')->name('update');
                //         Route::get('/detail/{position}', 'show')->name('detail');
                //         Route::get('/edit/{position}', 'edit')->name('edit');
                //         Route::delete('/{position}', 'destroy')->name('delete');
                //         Route::post('/data', function () {
                //             return DataTables::of(Position::orderBy('id', 'ASC')->get())->make(true);
                //         })->name('data');
                //     });
                // });
                Route::prefix('user')->group(function () {
                    Route::group(['prefix' => '/admin', 'controller' => AdminController::class], function () {
                        Route::name('users.admin.')->group(function () {
                            Route::get('', 'index')->name('index');
                            // Route::post('', 'store')->name('store');
                            // Route::get('/add', 'create')->name('add');
                            Route::put('/{user}', 'update')->name('update');
                            Route::get('/detail/{admin}', 'show')->name('detail');
                            Route::get('/edit/{user}', 'edit')->name('edit');
                            Route::delete('/{user}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(User::latest()->get()->load('position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/guru', 'controller' => TeacherController::class], function () {
                        Route::name('users.teacher.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::get('/edit/{teacher}', 'edit')->name('edit');
                            Route::put('/{teacher}', 'update')->name('update');
                            // Route::get('/detail/{teacher}', 'show')->name('detail');
                            // Route::delete('/{teacher}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(Teacher::latest()->get()->load('user', 'user.position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/siswa', 'controller' => StudentController::class], function () {
                        Route::name('users.student.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{student}', 'update')->name('update');
                            Route::get('/detail/{student}', 'show')->name('detail');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });

                    Route::group(['prefix' => '/ortu', 'controller' => ParentsController::class], function () {
                        Route::name('users.parents.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{parents}', 'update')->name('update');
                            Route::get('/edit/{parents}', 'edit')->name('edit');
                            Route::delete('/{parents}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                        });
                    });

                    Route::group(['prefix' => '/staff', 'controller' => StaffController::class], function () {
                        Route::name('users.staff.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::put('/{staff}', 'update')->name('update');
                            // Route::get('/detail/{staff}', 'show')->name('detail');
                            Route::get('/edit/{staff}', 'edit')->name('edit');
                            // Route::delete('/{staff}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                // return Staff::latest()->get()->load('user', 'user.position');
                                return DataTables::of(Staff::latest()->get()->load('user', 'user.position'))->make(true);
                            })->name('data');
                        });
                    });
                    Route::group(['prefix' => '/alumni', 'controller' => AlumniController::class], function () {
                        Route::name('users.alumni.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::get('/edit/{student}', 'edit')->name('edit');
                            Route::put('/{student}', 'update')->name('update');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', 'data')->name('data');
                            Route::get('/detail/{student}', 'show')->name('detail');
                            // Route::post('', 'store')->name('store');
                            // Route::get('/add', 'create')->name('add');
                            // Route::delete('/{student}', 'destroy')->name('delete');
                        });
                    });
                    Route::group(['prefix' => 'school-profile', 'controller' => SchoolProfileController::class], function () {
                        Route::name('school.profile.')->group(function () {
                            Route::get('', 'edit')->name('index');
                            Route::put('', 'update')->name('update');
                        });
                    });
                });
                Route::prefix('berita')->group(function () {
                    Route::name('news.')->group(function () {
                        //news category
                        Route::group(['prefix' => 'kategori', 'controller' => NewsCategoryController::class], function () {
                            Route::name('category.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', function () {
                                    return DataTables::of(NewsCategory::all())->make(true);
                                })->name('data');
                                Route::get('/edit/{NewsCategory}', 'edit')->name('edit');
                                Route::put('/edit/{NewsCategory}', 'update')->name('update');
                                Route::delete('/{NewsCategory}', 'destroy')->name('delete');
                            });
                        });

                        //news
                        Route::group(['controller' => NewsController::class], function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::post('/data', function () {
                                return DataTables::of(News::latest()->get())->make(true);
                            })->name('data');
                            Route::get('/edit/{news}', 'edit')->name('edit');
                            Route::put('/edit/{news}', 'update')->name('update');
                            Route::delete('/{news}', 'destroy')->name('delete');
                        });
                    });
                });
            });
        });
    });
    Route::prefix('akademik')->group(function () {
        Route::name('akademik.')->group(function () {
            Route::get('/', function () {
                return view('index');
            })->name('dashboard');

            Route::middleware(['staff.akademik'])->group(function () {
                Route::prefix('user')->group(function () {
                    Route::group(['prefix' => '/admin', 'controller' => AkademikAdmin::class], function () {
                        Route::name('users.admin.')->group(function () {
                            Route::get('', 'index')->name('index');
                            // Route::post('', 'store')->name('store');
                            // Route::get('/add', 'create')->name('add');
                            Route::put('/{user}', 'update')->name('update');
                            Route::get('/detail/{admin}', 'show')->name('detail');
                            Route::get('/edit/{user}', 'edit')->name('edit');
                            Route::delete('/{user}', 'destroy')->name('delete');
                            Route::post('/switch', 'switch')->name('switch');
                            Route::post('/data', function () {
                                return DataTables::of(User::where(['position_id' => '3'])->orWhere('position_id', '4')->get()->load('position'))->make(true);
                            })->name('data');
                        });
                        Route::group(['prefix' => '/guru', 'controller' => AkademikTeacher::class], function () {
                            Route::name('users.teacher.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::get('/edit/{teacher}', 'edit')->name('edit');
                                Route::put('/{teacher}', 'update')->name('update');
                                // Route::get('/detail/{teacher}', 'show')->name('detail');
                                Route::delete('/{teacher}', 'destroy')->name('delete');
                                Route::post('/switch', 'switch')->name('switch');
                                Route::post('/data', 'data')->name('data');
                            });
                        });
                        Route::group(['prefix' => '/siswa', 'controller' => AkademikStudent::class], function () {
                            Route::name('users.student.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::get('/add', 'create')->name('add');
                                Route::get('/{student:nis}', 'show')->name('show');
                                Route::post('', 'store')->name('store');
                                Route::put('/{student}', 'update')->name('update');
                                Route::get('/edit/{student}', 'edit')->name('edit');
                                Route::delete('/{student}', 'destroy')->name('delete');
                                Route::post('/switch', 'switch')->name('switch');
                                Route::post('/data', 'data')->name('data');
                            });
                        });

                        Route::group(['prefix' => '/ortu', 'controller' => AkademikParents::class], function () {
                            Route::name('users.parents.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::put('/{parents}', 'update')->name('update');
                                Route::get('/edit/{parents}', 'edit')->name('edit');
                                Route::delete('/{parents}', 'destroy')->name('delete');
                                Route::post('/switch', 'switch')->name('switch');
                                Route::post('/data', 'data')->name('data');
                            });
                        });

                        Route::group(['prefix' => '/alumni', 'controller' => AkademikAlumni::class], function () {
                            Route::name('users.alumni.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::get('/edit/{student}', 'edit')->name('edit');
                                Route::put('/{student}', 'update')->name('update');
                                Route::post('/switch', 'switch')->name('switch');
                                Route::post('/data', 'data')->name('data');
                                Route::get('/detail/{student}', 'show')->name('detail');
                                // Route::post('', 'store')->name('store');
                                // Route::get('/add', 'create')->name('add');
                                // Route::delete('/{student}', 'destroy')->name('delete');
                            });
                        });
                    });
                });
                Route::group(['prefix' => 'jurusan', 'controller' => MajorController::class], function () {
                    Route::name('major.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{major}', 'update')->name('update');
                        // Route::get('/detail/{major}', 'show')->name('detail');
                        Route::get('/edit/{major}', 'edit')->name('edit');
                        Route::delete('/{major}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'kelas', 'controller' => ClassesController::class], function () {
                    Route::name('classes.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{classes}', 'update')->name('update');
                        Route::get('/detail/{classes}', 'show')->name('detail');
                        Route::post('/detail/{classes}/data', 'studentData')->name('student.data');
                        Route::get('/edit/{classes}', 'edit')->name('edit');
                        Route::delete('/{classes}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => 'tahun-ajaran', 'controller' => SchoolYearController::class], function () {
                    Route::name('school.year.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{schoolYear}', 'update')->name('update');
                        // Route::get('/detail/{schoolYear}', 'show')->name('detail');
                        Route::get('/edit/{schoolYear}', 'edit')->name('edit');
                        Route::delete('/{schoolYear}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'mapel/kategori', 'controller' => CategorySubjectController::class], function () {
                    Route::name('mapel.category.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{categorySubject}', 'update')->name('update');
                        // Route::get('/detail/{categorySubject}', 'show')->name('detail');
                        Route::get('/edit/{categorySubject}', 'edit')->name('edit');
                        Route::delete('/{categorySubject}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'mapel', 'controller' => SubjectController::class], function () {
                    Route::name('mapel.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{subject}', 'update')->name('update');
                        // Route::get('/detail/{subject}', 'show')->name('detail');
                        Route::get('/edit/{subject}', 'edit')->name('edit');
                        Route::delete('/{subject}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'setting/kelas', 'controller' => SettingClassController::class], function () {
                    Route::name('setting.class.')->group(function () {
                        Route::get('', 'class')->name('class');
                        Route::get('/{class:code}', 'index')->name('index');
                        Route::get('/{class:code}/add', 'create')->name('add');
                        Route::post('/{class:code}/add', 'store')->name('store');
                        // Route::get('/detail/{id}', 'show')->name('detail');
                        Route::get('/{class:code}/edit/{settingClass}', 'edit')->name('edit');
                        Route::put('/{class:code}/edit/{settingClass}', 'update')->name('update');
                        Route::put('/{class:code}/wali', 'update_homeroom')->name('update.homeroom');
                        Route::delete('/{class:code}/{settingClass}', 'destroy')->name('delete');
                        Route::post('/{class:code}/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => 'pindah-kelas', 'controller' => ClassPromotionController::class], function () {
                    Route::name('pindah.class.')->group(function () {
                        Route::get('', 'class')->name('class');
                        Route::get('/{class:code}', 'index')->name('index');
                        Route::get('/{class:code}/add', 'create')->name('add');
                        Route::post('/{class:code}/pindah', 'store')->name('store');
                        // Route::get('/detail/{id}', 'show')->name('detail');
                        Route::get('/{class:code}/edit/{settingClass}', 'edit')->name('edit');
                        Route::put('/{class:code}/edit/{settingClass}', 'update')->name('update');
                        Route::put('/{class:code}/wali', 'update_homeroom')->name('update.homeroom');
                        Route::delete('/{class:code}/{settingClass}', 'destroy')->name('delete');
                        Route::post('/{class:code}/data', 'data')->name('data');
                    });
                });
            });

            Route::middleware(['teacher'])->group(function () {
                Route::group(['prefix' => '/jurnal'], function () {
                    Route::controller(DailyJournalController::class)->group(function () {
                        Route::name('journal.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::get('/edit/{dailyJournal}', 'edit')->name('edit');
                            Route::put('{dailyJournal}', 'update')->name('update');
                            Route::delete('/{dailyJournal}', 'destroy')->name('delete');
                            Route::post('/data', 'data')->name('data');
                        });
                    });

                    Route::prefix('/{dailyJournal}/tugas')->group(function () {
                        Route::controller(TaskController::class)->group(function () {
                            Route::name('journal.task.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::get('/edit/{task}', 'edit')->name('edit');
                                Route::put('{task}', 'update')->name('update');
                                Route::delete('/{task}', 'destroy')->name('delete');
                                Route::post('/data', 'data')->name('data');
                            });
                        });

                        Route::prefix('/{task}/nilai')->group(function () {
                            Route::controller(ScoreController::class)->group(function () {
                                Route::name('journal.task.score.')->group(function () {
                                    Route::get('', 'index')->name('index');
                                    Route::post('', 'store')->name('store');
                                    Route::get('/add', 'create')->name('add');
                                    Route::get('/edit/{score}', 'edit')->name('edit');
                                    Route::put('{score}', 'update')->name('update');
                                    Route::delete('/{score}', 'destroy')->name('delete');
                                    Route::post('/data', 'data')->name('data');
                                });
                            });
                        });
                    });

                    Route::prefix('/{dailyJournal}/presensi')->group(function () {
                        Route::controller(AttendanceController::class)->group(function () {
                            Route::name('journal.attendance.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('add');
                                Route::post('/data', 'data')->name('data');
                            });
                        });
                    });
                });
                Route::prefix('laporan/presensi')->group(function () {
                    Route::controller(ReportAttendanceController::class)->group(function () {
                        Route::name('report.attendance.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::get('/detail/{student}', 'show')->name('detail');
                            Route::post('/detail/{student}/data', 'dataAttendance')->name('student.data');
                            Route::post('/data/{classCode}', 'data')->name('data');
                        });
                    });
                });
            });
            Route::prefix('monitor')->group(function () {
                Route::middleware(['parents'])->group(function () {
                    Route::controller(AkademikMonitor::class)->group(function () {
                        Route::name('monitor.parents.')->group(function () {
                            Route::get('', 'index')->name('index');
                            Route::get('/detail/{student}', 'showStudent')->name('student.detail');
                            Route::post('/data', 'data')->name('data');
                            Route::get('/detail/{student}/presensi', 'showAttendance')->name('student.detail.attendance');
                            Route::post('/detail/{student}/presensi', 'dataAttendance')->name('student.detail.attendance.data');
                            Route::get('/detail/{student}/nilai', 'showScore')->name('student.detail.score');
                            Route::post('/detail/{student}/nilai', 'dataScore')->name('student.detail.score.data');
                        });
                    });
                });

                Route::middleware(['student'])->group(function () {
                    Route::controller(AkademikStudentMonitor::class)->group(function () {
                        Route::name('monitor.student.')->group(function () {
                            Route::get('siswa/todo', 'indexTodo')->name('todo.index');
                            Route::post('siswa/todo/data', 'dataTodo')->name('todo.data');

                            Route::get('siswa/presensi', 'indexAttendance')->name('attendance.index');
                            Route::post('siswa/presensi/data', 'dataAttendance')->name('attendance.data');

                            Route::get('siswa/nilai', 'indexScore')->name('score.index');
                            Route::post('siswa/nilai/data', 'dataScore')->name('score.data');

                            Route::get('siswa/jadwal', 'indexSchedule')->name('schedule.index');
                            Route::post('siswa/jadwal/data', 'dataSchedule')->name('schedule.data');
                        });
                    });
                });
            });
        });
    });
    Route::middleware(['staff.sarpras'])->group(function () {
        Route::prefix('sarpras')->group(function () {
            Route::name('sarpras.')->group(function () {
                Route::group(['prefix' => 'ruang', 'controller' => RoomController::class], function () {
                    Route::name('ruang.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{room}', 'update')->name('update');
                        // Route::get('/detail/{room}', 'show')->name('detail');
                        Route::get('/edit/{room}', 'edit')->name('edit');
                        Route::delete('/{room}', 'destroy')->name('delete');
                        Route::post('/switch', 'switch')->name('switch');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'supplier', 'controller' => SupplierController::class], function () {
                    Route::name('supplier.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{supplier}', 'update')->name('update');
                        // Route::get('/detail/{room}', 'show')->name('detail');
                        Route::get('/edit/{supplier}', 'edit')->name('edit');
                        Route::delete('/{supplier}', 'destroy')->name('delete');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::prefix('barang')->group(function () {
                    Route::name('item.')->group(function () {
                        //items category
                        Route::group(['prefix' => 'kategori', 'controller' => ItemCategoryController::class], function () {
                            Route::name('category.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', 'data')->name('data');
                                Route::get('/edit/{itemCategory}', 'edit')->name('edit');
                                Route::put('/edit/{itemCategory}', 'update')->name('update');
                                Route::delete('/{itemCategory}', 'destroy')->name('delete');
                            });
                        });

                        //items
                        Route::group(['controller' => ItemController::class], function () {
                            Route::get('', 'index')->name('index');
                            Route::post('', 'store')->name('store');
                            Route::get('/add', 'create')->name('add');
                            Route::post('/data', 'data')->name('data');
                            Route::get('/edit/{item}', 'edit')->name('edit');
                            Route::put('/edit/{item}', 'update')->name('update');
                            Route::delete('/{item}', 'destroy')->name('delete');
                        });

                        //items outcoming
                        Route::group(['prefix' => 'keluar', 'controller' => ItemOutController::class], function () {
                            Route::name('out.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', 'data')->name('data');
                                // Route::get('/edit/{itemOut}', 'edit')->name('edit');
                                // Route::put('/edit/{itemOut}', 'update')->name('update');
                                // Route::delete('/{itemOut}', 'destroy')->name('delete');
                            });
                        });
                    });
                });

                Route::group(['prefix' => 'pengadaan', 'controller' => ProcurementController::class], function () {
                    Route::name('procurement.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/edit/{procurement}', 'edit')->name('edit');
                        Route::put('/edit/{procurement}', 'update')->name('update');
                        Route::get('/{procurement}', 'show')->name('detail');
                        Route::post('/{procurement}/complete', 'complete')->name('complete');
                        Route::delete('/{procurement}', 'destroy')->name('delete');
                        Route::put('{procurement}/receipt', 'receipt')->name('receipt.update');
                    });
                });
            });
        });
    });

    Route::middleware(['staff.keuangan'])->group(function () {
        Route::prefix('keuangan')->group(function () {
            Route::name('finance.')->group(function () {
                Route::controller(SubmissionController::class)->group(function () {
                    //procurement
                    Route::prefix('pengajuan')->group(function () {
                        Route::name('procurement.')->group(function () {
                            Route::get('', 'indexProcurement')->name('index');
                            Route::get('/{procurement}', 'showProcurement')->name('detail');
                            Route::post('', 'dataProcurement')->name('data');
                            Route::post('/reset/{procurement}', 'resetProcurement')->name('reset');
                            Route::post('/approve/{procurement}', 'approveProcurement')->name('approve');
                            Route::get('/reject/{procurement}', 'rejectDetail')->name('reject.detail');
                            Route::post('/reject/{procurement}', 'rejectProcurement')->name('reject');
                        });
                    });
                });
            });
        });
    });
    Route::middleware(['staff.humas'])->group(function () {
        Route::prefix('tamu')->group(function () {
            Route::name('tamu.')->group(function () {
                Route::get('/dashboard', function () {
                    return view('index');
                })->name('dashboard');
                Route::group(['controller' => GuestBookController::class], function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::post('/add', 'store')->name('store');
                    Route::post('/data', 'data')->name('data');
                    Route::get('/edit/{guestBook}', 'edit')->name('edit');
                    Route::put('/edit/{guestBook}', 'update')->name('update');
                    Route::delete('/{guestBook}', 'destroy')->name('delete');
                });
                Route::group(['prefix' => 'laporan', 'controller' => GuestBookReportController::class], function () {
                    Route::name('laporan.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/export/{start}/{end}', 'export')->name('export');
                    });
                });
            });
        });
        Route::prefix('arsip')->group(function () {
            Route::name('arsip.')->group(function () {
                Route::get('/', function () {
                    return view('index');
                })->name('dashboard');
                Route::prefix('surat')->group(function () {
                    Route::name('surat.')->group(function () {
                        //mails category
                        Route::group(['prefix' => 'kategori', 'controller' => MailCategoryController::class], function () {
                            Route::name('category.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', 'data')->name('data');
                                Route::get('/edit/{mailCategory}', 'edit')->name('edit');
                                Route::put('/edit/{mailCategory}', 'update')->name('update');
                                Route::delete('/{mailCategory}', 'destroy')->name('delete');
                            });
                        });

                        //mails incoming
                        Route::group(['prefix' => 'masuk', 'controller' => MailInController::class], function () {
                            Route::name('in.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', 'data')->name('data');
                                Route::get('/edit/{mailIn}', 'edit')->name('edit');
                                Route::put('/edit/{mailIn}', 'update')->name('update');
                                Route::delete('/{mailIn}', 'destroy')->name('delete');
                                Route::group(['prefix' => '{mailIn}/disposisi', 'controller' => DispositionController::class], function () {
                                    Route::name('disposisi.')->group(function () {
                                        Route::get('/add', 'create')->name('add');
                                        Route::post('/add', 'store')->name('store');
                                        Route::put('/edit/{disposition}', 'update')->name('update');
                                    });
                                });
                            });
                        });

                        //mails outcoming
                        Route::group(['prefix' => 'keluar', 'controller' => MailOutController::class], function () {
                            Route::name('out.')->group(function () {
                                Route::get('', 'index')->name('index');
                                Route::post('', 'store')->name('store');
                                Route::get('/add', 'create')->name('add');
                                Route::post('/data', 'data')->name('data');
                                Route::get('/edit/{mailOut}', 'edit')->name('edit');
                                Route::put('/edit/{mailOut}', 'update')->name('update');
                                Route::delete('/{mailOut}', 'destroy')->name('delete');
                            });
                        });
                    });
                });
                Route::group(['prefix' => 'laporan/masuk', 'controller' => ReportInController::class], function () {
                    Route::name('report.in.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/export/{start}/{end}', 'export')->name('export');
                    });
                });
                Route::group(['prefix' => 'laporan/keluar', 'controller' => ReportOutController::class], function () {
                    Route::name('report.out.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('/data', 'data')->name('data');
                        Route::get('/export/{start}/{end}', 'export')->name('export');
                    });
                });
            });
        });
    });

    Route::middleware(['staff.uks'])->group(function () {
        Route::prefix('uks')->group(function () {
            Route::name('uks.')->group(function () {
                Route::get('', function () {
                    return view('index');
                })->name('dashboard');

                Route::group(['prefix' => 'obat', 'controller' => MedicineController::class], function () {
                    Route::name('obat.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{medicine}', 'update')->name('update');
                        // Route::get('/detail/{medicine}', 'show')->name('detail');
                        Route::get('/edit/{medicine}', 'edit')->name('edit');
                        Route::delete('/{medicine}', 'destroy')->name('delete');
                        Route::post('/data', 'data')->name('data');
                    });
                });
                Route::group(['prefix' => 'petugas', 'controller' => UksOfficerController::class], function () {
                    Route::name('petugas.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::put('/{uksOfficer}', 'update')->name('update');
                        // Route::get('/detail/{uksOfficer}', 'show')->name('detail');
                        Route::get('/edit/{uksOfficer}', 'edit')->name('edit');
                        Route::delete('/{uksOfficer}', 'destroy')->name('delete');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => 'pasien', 'controller' => PatientController::class], function () {
                    Route::name('pasien.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('/add', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        // Route::get('/detail/{patient}', 'show')->name('detail');
                        Route::put('/edit/{patient}', 'update')->name('update');
                        Route::get('/edit/{patient}', 'edit')->name('edit');
                        Route::delete('/{patient}', 'destroy')->name('delete');
                        Route::post('/data', 'data')->name('data');
                    });
                });
            });
        });
    });

    Route::middleware(['staff.perpus'])->group(function () {
        Route::prefix('perpustakaan')->group(function () {
            Route::name('perpustakaan.')->group(function () {
                Route::get('', function () {
                    return view('index');
                })->name('dashboard');

                Route::group(['prefix' => 'buku', 'controller' => BookController::class], function () {
                    Route::name('book.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', function () {
                            return DataTables::of(Book::latest()->get()->load('category', 'author'))->make(true);
                        })->name('data');
                        Route::get('/edit/{book}', 'edit')->name('edit');
                        Route::put('/edit/{book}', 'update')->name('update');
                        Route::delete('/{book}', 'destroy')->name('delete');
                    });
                });
                Route::group(['prefix' => 'kategori', 'controller' => BookCategoryController::class], function () {
                    Route::name('category.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', function () {
                            return DataTables::of(BookCategory::latest()->get())->make(true);
                        })->name('data');
                        Route::get('/edit/{bookcategory}', 'edit')->name('edit');
                        Route::put('/edit/{bookcategory}', 'update')->name('update');
                        Route::delete('/{bookcategory}', 'destroy')->name('delete');
                    });
                });

                Route::group(['prefix' => 'penulis', 'controller' => AuthorController::class], function () {
                    Route::name('author.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::post('/data', function () {
                            return DataTables::of(Author::latest()->get())->make(true);
                        })->name('data');
                        Route::get('/edit/{author}', 'edit')->name('edit');
                        Route::put('/edit/{author}', 'update')->name('update');
                        Route::delete('/{author}', 'destroy')->name('delete');
                    });
                });

                Route::group(['prefix' => 'peminjam', 'controller' => RentalController::class], function () {
                    Route::name('rental.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::get('/edit/{rental}', 'edit')->name('edit');
                        Route::put('/edit/{rental}', 'update')->name('update');
                        Route::post('/{rental}/dikembalikan', 'turned')->name('turned');
                        Route::delete('/{rental}', 'destroy')->name('delete');
                        Route::get('/{rental}', 'show')->name('detail');
                        Route::post('/data', 'data')->name('data');
                    });
                });

                Route::group(['prefix' => '/{rental}/telat-pengembalian', 'controller' => BorrowingFineController::class], function () {
                    Route::name('fine.')->group(function () {
                        Route::get('', 'index')->name('index');
                        Route::post('', 'store')->name('store');
                        Route::get('/add', 'create')->name('add');
                        Route::get('/edit/{fine}', 'edit')->name('edit');
                        Route::put('/edit/{fine}', 'update')->name('update');
                        Route::delete('/{fine}', 'destroy')->name('delete');
                        Route::post('/data', 'data')->name('data');
                    });
                });
            });
        });
    });
});
