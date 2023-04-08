<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'instance',
        'necessary',
        'date',
    ];

    function format_indo($date){
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;

        return $result;
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['start'] ?? false, function ($query, $start) {
            return $query->where('date', '>=', $start );
        });

        $query->when($filters['end'] ?? false, function ($query, $end) {
            return $query->where('date', '<=', $end );
        });
        
    }
    

    public function getTanggalAttribute()
    {
        return $this->format_indo($this->attributes['date']);
    }

}


// senin-selasa-rabu = projek in house
// kamis - jumat  = produk urgent healing