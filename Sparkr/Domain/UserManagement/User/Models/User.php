<?php

namespace Sparkr\Domain\UserManagement\User\Models;

use Carbon\Carbon;
use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\Location\Models\Location;
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

    private ?int $followedCount;

    private ?Carbon $lastLogin;

    private ?string $image;

    private ?int $status;

    private ?Location $location;

    /**
     * User constructor.
     * @param  string  $email
     * @param  string  $password
     * @param  string|null  $name
     * @param  int|null  $userType
     * @param  int|null  $experienceLevel
     * @param  int|null  $locationId
     * @param  int|null  $sparkCount
     * @param  int|null  $followingCount
     * @param  int|null  $followedCount
     * @param  Carbon|null  $lastLogin
     * @param  string|null  $image
     * @param  int|null  $status
     */
    public function __construct(
        string $email,
        string $password,
        ?string $name =null,
        ?int $userType=null,
        ?int $experienceLevel=null,
        ?int $locationId=null,
        ?int $sparkCount=0,
        ?int $followingCount=0,
        ?int $followedCount=0,
        ?Carbon $lastLogin=null,
        ?string $image=null,
        ?int $status=UserStatus::Active
    ) {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setName($name);
        $this->setUserType($userType);
        $this->setExperienceLevel($experienceLevel);
        $this->setLocationId($locationId);
        $this->setSparkCount($sparkCount);
        $this->setFollowingCount($followingCount);
        $this->setFollowedCount($followedCount);
        $this->setLastLogin($lastLogin);
        $this->setImage($image);
        $this->setStatus($status);
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
    public function getFollowedCount(): ?int
    {
        return $this->followedCount;
    }

    /**
     * @param  int|null  $followedCount
     */
    public function setFollowedCount(?int $followedCount): void
    {
        $this->followedCount = $followedCount;
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

}
