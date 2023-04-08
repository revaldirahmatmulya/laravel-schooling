<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Administrator()
 * @method static static Staff()
 * @method static static Teacher()
 * @method static static Student()
 * @method static static Alumni()
 * @method static static Parents()
 */
final class PositionType extends Enum
{
    const Administrator = 1;
    const StaffAkademik = 2;
    const Teacher = 3;
    const Student = 4;
    const Alumni = 5;
    const Parents = 6;
    const StaffSarpras = 7;
    const StaffKeuangan = 8;
    const StaffPerpustakaan = 9;
    const StaffHumas = 10;
    const StaffUks = 11;
}