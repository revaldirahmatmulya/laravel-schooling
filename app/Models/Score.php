<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'student_id',
        'task_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
}
