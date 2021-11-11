<?php

namespace Sparkr\Domain\UserManagement\User\Enums;

use Sparkr\Utility\Enums\IntEnum;

/**
 * @method static static Active()
 * @method static static Inactive()
 */
final class UserStatus extends IntEnum
{
    public const ACTIVE = 1;
    public const INACTIVE = 0;
}
