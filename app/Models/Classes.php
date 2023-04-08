<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'code',
        'name',
        'status',
        'major_id',
        'teacher_id'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'classes_id');
    }
    
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function getSiswaAttribute()
    {
        $student = Student::where('classes_id', $this->attributes['id'])->NotAlumni()->count();
        return $student;
    }
    public function getMapelAttribute()
    {
        $mapel = SettingClass::where('classes_id', $this->attributes['id'])->count();
        return $mapel;
    }
}