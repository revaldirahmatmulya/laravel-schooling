<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyJournal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'class_id',
        'subject_id',
        'teacher_id',
    ];
    
    public function class(){
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class, 'daily_journal_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'daily_journal_id');
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['class'] ?? false, function ($query, $class_id) {
            return $query->where('class_id', $class_id);
        });        
        
    }
}
