<?php

namespace Sparkr\Domain\MasterDataManagement\Availability\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static FullTime()
 * @method static static PartTime()
 * @method static static Contract()
 * @method static static Internship()
 */
final class Availability extends Enum
{
    const FullTime = 1;
    const PartTime = 2;
    const Contract = 3;
    const Internship = 4;
}
