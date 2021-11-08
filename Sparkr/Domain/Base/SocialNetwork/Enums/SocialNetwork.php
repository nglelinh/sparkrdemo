<?php

namespace Sparkr\Domain\MasterDataManagement\SocialNetwork\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Facebook()
 * @method static static Instagram()
 * @method static static Twitter()
 */
final class SocialNetwork extends Enum
{
    const Facebook = 'Facebook';
    const Instagram = 'Instagram';
    const Twitter = 'Twitter';
}
