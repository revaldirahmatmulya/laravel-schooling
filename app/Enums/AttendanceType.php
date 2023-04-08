<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AttendanceType extends Enum
{
    const Hadir = 'hadir';
    const Sakit = 'sakit';
    const Izin = 'izin';
    const Alpa = 'alpa';
}
