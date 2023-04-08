<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nisn',
        'user_id',
        'classes_id',
        'parent_id',
        'gender',
        'birthdate',
        'birthplace',
        'phone',
        'address',
        'religion',
        'generation',
        'alumni',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'student_id');
    }

    public function fine()
    {
        return $this->hasMany(BorrowingFine::class, 'student_id');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'student_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function scopeNotAlumni($query)
    {
        $query->where('alumni', 0);
    }
    public function scopeAlumni($query)
    {
        $query->where('alumni', 1);
    }
}