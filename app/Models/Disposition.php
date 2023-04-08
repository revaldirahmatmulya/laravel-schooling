<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail_in_id',
        'destination',
        'message',
    ];

    public function mailIn()
    {
        return $this->belongsTo(MailIn::class, 'mail_in_id');
    }
}
