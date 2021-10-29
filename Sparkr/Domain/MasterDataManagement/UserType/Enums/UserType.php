<?php

namespace Sparkr\Domain\MasterDataManagement\UserType\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Person()
 * @method static static Company()
 */
final class UserType extends Enum
{
    const Person = 1;
    const Company = 2;
}
