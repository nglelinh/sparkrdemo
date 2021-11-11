<?php

namespace Sparkr\Domain\UserManagement\User\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\Location\Models\Location;
use Sparkr\Domain\UserManagement\User\Enums\UserParam;
use Sparkr\Domain\UserManagement\User\Enums\UserStatus;
use Sparkr\Utility\Enums\Status;

/**
 *
 */
class User extends BaseDomainModel
{
    private ?string $name;

    private string $email;

    private string $password;

    private ?int $userType;

    private ?int $experienceLevel;

    private ?int $locationId;

    private ?int $sparkCount;

    private ?int $followingCount;

    private ?int $followerCount;

    private ?Carbon $lastLogin;

    private ?string $image;

    private ?int $status;

    private ?Location $location;

    private Collection $socialLinks;

//    private Collection $sparkSkills;

    private ?string $description;

    /**
     * User constructor.
     * @param array $param
     *
     */
    public function __construct(array $param)
    {
        $this->setDataByParam($param);
    }

    public function setDataByParam(array $param): void
    {
        $this->setEmail($param[UserParam::EMAIL]);
        $this->setPassword($param[UserParam::PASSWORD]);
        $this->setName($param[UserParam::NAME] ?? null);
        $this->setUserType($param[UserParam::USER_TYPE] ?? null);
        $this->setExperienceLevel($param[UserParam::EXPERIENCE_LEVEL] ?? null);
        $this->setLocationId($param[UserParam::LOCATION_ID] ?? null);
        $this->setSparkCount($param[UserParam::SPARK_COUNT] ?? 0);
        $this->setFollowingCount($param[UserParam::FOLLOWING_COUNT] ?? 0);
        $this->setFollowerCount($param[UserParam::FOLLOWER_COUNT] ?? 0);
        $this->setLastLogin($param[UserParam::LAST_LOGIN] ?? null);
        $this->setImage($param[UserParam::IMAGE] ?? null);
        $this->setStatus($param[UserParam::STATUS] ?? UserStatus::ACTIVE);
        $this->setDescription($param[UserParam::DESCRIPTION] ?? null);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  string|null  $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string  $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  string  $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int|null
     */
    public function getUserType(): ?int
    {
        return $this->userType;
    }

    /**
     * @param  int|null  $userType
     */
    public function setUserType(?int $userType): void
    {
        $this->userType = $userType;
    }

    /**
     * @return int|null
     */
    public function getExperienceLevel(): ?int
    {
        return $this->experienceLevel;
    }

    /**
     * @param  int|null  $experienceLevel
     */
    public function setExperienceLevel(?int $experienceLevel): void
    {
        $this->experienceLevel = $experienceLevel;
    }

    /**
     * @return int|null
     */
    public function getSparkCount(): ?int
    {
        return $this->sparkCount;
    }

    /**
     * @param  int|null  $sparkCount
     */
    public function setSparkCount(?int $sparkCount): void
    {
        $this->sparkCount = $sparkCount;
    }

    /**
     * @return int|null
     */
    public function getFollowingCount(): ?int
    {
        return $this->followingCount;
    }

    /**
     * @param  int|null  $followingCount
     */
    public function setFollowingCount(?int $followingCount): void
    {
        $this->followingCount = $followingCount;
    }

    /**
     * @return int|null
     */
    public function getFollowerCount(): ?int
    {
        return $this->followerCount;
    }

    /**
     * @param  int|null  $followerCount
     */
    public function setFollowerCount(?int $followerCount): void
    {
        $this->followerCount = $followerCount;
    }

    /**
     * @return Carbon|null
     */
    public function getLastLogin(): ?Carbon
    {
        return $this->lastLogin;
    }

    /**
     * @param  Carbon|null  $lastLogin
     */
    public function setLastLogin(?Carbon $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param  string|null  $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param  int|null  $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    public function toggleStatus()
    {
        $this->status = $this->status == Status::Active ? Status::Inactive : Status::Active;
    }

    /**
     * @return int|null
     */
    public function getLocationId(): ?int
    {
        return $this->locationId;
    }

    /**
     * @param  int|null  $locationId
     */
    public function setLocationId(?int $locationId): void
    {
        $this->locationId = $locationId;
    }

    /**
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @param  Location|null  $location
     */
    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return Collection
     */
    public function getSocialLinks(): Collection
    {
        return $this->socialLinks;
    }

    /**
     * @param  Collection  $socialLinks
     */
    public function setSocialLinks(Collection $socialLinks): void
    {
        $this->socialLinks = $socialLinks;
    }

//    /**
//     * @return Collection
//     */
//    public function getSparkSkills(): Collection
//    {
//        return $this->sparkSkills;
//    }
//
//    /**
//     * @param  Collection  $sparkSkills
//     */
//    public function setSparkSkills(Collection $sparkSkills): void
//    {
//        $this->sparkSkills = $sparkSkills;
//    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param  string|null  $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function incrementFollower(): void
    {
        $this->followerCount++;
    }

    public function incrementFollowing(): void
    {
        $this->followingCount++;
    }
    public function decrementFollower(): void
    {
        $this->followerCount--;
    }

    public function decrementFollowing(): void
    {
        $this->followingCount--;
    }
}
