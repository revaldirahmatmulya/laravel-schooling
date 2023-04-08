<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UksOfficer extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'day',
        'time_start',
        'time_end',
    ];

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value), 
        );
    }
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
