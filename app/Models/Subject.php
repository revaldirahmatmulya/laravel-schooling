<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_subject_id',
        'code',
        'status',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
