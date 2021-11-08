<?php

namespace Sparkr\Domain\Base\UserType\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Person()
 * @method static static Company()
 */
final class UserType extends Enum
{
    const Personal = 1;
    const Company = 2;
}
