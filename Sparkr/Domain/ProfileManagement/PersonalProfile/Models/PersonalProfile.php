<?php

namespace Sparkr\Domain\ProfileManagement\PersonalProfile\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType;
use Sparkr\Domain\UserManagement\User\Models\User;

/**
 *
 */
class PersonalProfile extends BaseDomainModel
{
    private ?int $userId;

    private ?string $about;

    private ?string $desired_position;

    private ?string $education;

    private ?int $jobTypeId;

    private ?int $availabilityId;

    private ?User $user;

    private ?JobType $jobType;

    /**
     * PersonalProfile constructor.
     * @param  int|null  $userId
     * @param  string|null  $about
     * @param  string|null  $desired_position
     * @param  string|null  $education
     * @param  int|null  $jobTypeId
     * @param  int|null  $availabilityId
     */
    public function __construct(
        ?int $userId,
        ?string $desired_position = null,
        ?string $about = null,
        ?string $education = null,
        ?int $jobTypeId = null,
        ?int $availabilityId = null
    ) {
        $this->userId = $userId;
        $this->about = $about;
        $this->desired_position = $desired_position;
        $this->education = $education;
        $this->jobTypeId = $jobTypeId;
        $this->availabilityId = $availabilityId;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param  int|null  $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getAbout(): ?string
    {
        return $this->about;
    }

    /**
     * @param  string|null  $about
     */
    public function setAbout(?string $about): void
    {
        $this->about = $about;
    }

    /**
     * @return string|null
     */
    public function getDesiredPosition(): ?string
    {
        return $this->desired_position;
    }

    /**
     * @param  string|null  $desired_position
     */
    public function setDesiredPosition(?string $desired_position): void
    {
        $this->desired_position = $desired_position;
    }

    /**
     * @return string|null
     */
    public function getEducation(): ?string
    {
        return $this->education;
    }

    /**
     * @param  string|null  $education
     */
    public function setEducation(?string $education): void
    {
        $this->education = $education;
    }

    /**
     * @return int|null
     */
    public function getJobTypeId(): ?int
    {
        return $this->jobTypeId;
    }

    /**
     * @param  int|null  $jobTypeId
     */
    public function setJobTypeId(?int $jobTypeId): void
    {
        $this->jobTypeId = $jobTypeId;
    }

    /**
     * @return int|null
     */
    public function getAvailabilityId(): ?int
    {
        return $this->availabilityId;
    }

    /**
     * @param  int|null  $availabilityId
     */
    public function setAvailabilityId(?int $availabilityId): void
    {
        $this->availabilityId = $availabilityId;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param  User|null  $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return JobType|null
     */
    public function getJobType(): ?JobType
    {
        return $this->jobType;
    }

    /**
     * @param  JobType|null  $jobType
     */
    public function setJobType(?JobType $jobType): void
    {
        $this->jobType = $jobType;
    }


}
