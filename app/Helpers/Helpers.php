<?php

use Illuminate\Support\Facades\Route;

// if (!function_exists('get_the_locale')) {
//     function get_the_locale()
//     {
//         if (session('language')) {
//             return session('language');
//         }else {
//             return app()->getLocale();
//         }
//     }
// }

// if (!function_exists('get_route_locale')) {
//     function get_route_locale()
//     {
//         try {
//             return Route::current()->parameters()['locale'];
//         } catch (\Throwable $th) {
//             return 'id';
//         }
//     }
// }
function rupaih($angka)
{
    return "Rp " . number_format($angka,2,',','.');
}

if (!function_exists('format_indo')) {
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
  }