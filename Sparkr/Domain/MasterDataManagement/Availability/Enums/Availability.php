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
    const FullTime = 'Full-time';
    const PartTime = 'Part-time';
    const Contract = 'Contract';
    const Internship = 'Internship';
}
