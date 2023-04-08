<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'classes_id',
        'subject_id',
        'teacher_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getDayAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTimeAttribute(){
        return $this->start_time . ' - ' . $this->end_time;
    }
}
