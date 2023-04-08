<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'patient_description',
        'complaint',
        'handling',
        'date',
    ];


    public function medicines()
    {
        return $this->hasMany(PatientDetail::class, 'patient_id');
    }
}
