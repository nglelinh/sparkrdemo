<?php

namespace Sparkr\Domain\Base\Admin\Enums;

use Sparkr\Utility\Enums\StringEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Admin extends StringEnum
{
    const Admin = [
        'name' => 'Admin',
        'email' => 'admin@sparkr.com',
    ];
}
