<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ADMIN()
 * @method static static USER()
 * @method static static SUPERADMIN()
 */
final class UserType extends Enum
{
    const ADMIN = 'ADMIN';
    const USER = 'USER';
    const MANAGER = 'SUPERADMIN';
}

