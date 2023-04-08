<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rental;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowingFine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rental() {
        return $this->belongsTo(Rental::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
