<?php

namespace App\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'name',
        'description',
        'daily_journal_id',        
        'deadline',
    ];

    public function dailyJournal(){
        return $this->belongsTo(DailyJournal::class, 'daily_journal_id');
    }

    public function scores(){
        return $this->hasMany(Score::class, 'task_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
