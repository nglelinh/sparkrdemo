<?php

namespace Sparkr\Domain\MasterDataManagement\ExperienceLevel\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static EntryLevel()
 * @method static static Intermediate()
 * @method static static Expert()
 * @method static static Executive()
 */
final class ExperienceLevel extends Enum
{
    const EntryLevel = 1;
    const Intermediate = 2;
    const Expert = 3;
    const Executive = 4;
}
