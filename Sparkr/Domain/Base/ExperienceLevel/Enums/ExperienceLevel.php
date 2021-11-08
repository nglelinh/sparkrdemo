<?php

namespace Sparkr\Domain\Base\ExperienceLevel\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static EntryLevel()
 * @method static static Intermediate()
 * @method static static Expert()
 * @method static static Executive()
 */
final class ExperienceLevel extends Enum
{
    const EntryLevel = 'Entry Level';
    const Intermediate = 'Intermediate';
    const Expert = 'Expert';
    const Executive = 'Executive';
}
