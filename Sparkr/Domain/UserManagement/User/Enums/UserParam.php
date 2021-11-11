<?php

namespace Sparkr\Domain\UserManagement\User\Enums;

use Sparkr\Utility\Enums\StringEnum;

/**
 * @method static static Email()
 * @method static static Password()`
 * @method static static Name()
 * @method static static UserType()
 * @method static static ExperienceLevel()
 * @method static static LocationId()
 * @method static static SparkCount()
 * @method static static FollowingCount()
 * @method static static FollowerCount()
 * @method static static LastLogin()
 * @method static static Image()
 * @method static static Status()
 * @method static static Description()
 */
final class UserParam extends StringEnum
{
    public const EMAIL = "email";
    public const PASSWORD = "password";
    public const NAME = "name";
    public const USER_TYPE = "user_type";
    public const EXPERIENCE_LEVEL = "experience_level";
    public const LOCATION_ID = "location_id";
    public const SPARK_COUNT = "spark_count";
    public const FOLLOWING_COUNT = "following_count";
    public const FOLLOWER_COUNT = "follower_count";
    public const LAST_LOGIN = "last_login";
    public const IMAGE = "image";
    public const STATUS = "status";
    public const DESCRIPTION = "description";

}
