<?php

namespace Sparkr\Domain\UserManagement\User\Enums;

use Sparkr\Utility\Enums\IntEnum;

/**
 * @method static static Active()
 * @method static static Inactive()
 */
final class PersonalFilter extends IntEnum
{
    const ExperienceLevel = 'experience_level';
    const JobTypeId = 'job_type_id';
    const LocationId = 'location_id';
    const Availability = 'availability';
}
