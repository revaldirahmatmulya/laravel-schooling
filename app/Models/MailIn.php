<?php

namespace App\Models;

use App\Models\Disposition;
use App\Models\MailCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MailIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'title',
        'mail_category_id',
        'is_disposed',
        'file',
    ];

    public function category()
    {
        return $this->belongsTo(MailCategory::class, 'mail_category_id');
    }
    public function disposition()
    {
        return $this->hasOne(Disposition::class, 'mail_in_id');
    }

    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $hari = date("w", strtotime($date));
        $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;

        return $result;
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['start'] ?? false, function ($query, $start) {
            return $query->where('created_at', '>=', Carbon::createFromFormat('Y-m-d', $start)->startOfDay());
        });

        $query->when($filters['end'] ?? false, function ($query, $end) {
            return $query->where('created_at', '<=', Carbon::createFromFormat('Y-m-d', $end)->endOfDay());
        });
    }
}
