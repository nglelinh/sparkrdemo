<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Models;

use Illuminate\Support\Collection;
use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Domain\UserManagement\User\Models\User;

/**
 *
 */
class SparkSkill extends BaseDomainModel
{
    private int $userId;

    private int $skillId;

    private int $sparkSkillCount;

    private Skill $skill;

    private User $user;

    private ?int $userCreateId;

    private Collection $sparkDetails;

    /**
     * SparkSkill constructor.
     * @param  int  $userId
     * @param  int  $skillId
     * @param  int  $skillSparkCount
     * @param  int|null  $userCreateId
     */
    public function __construct(int $userId, int $skillId, int $skillSparkCount = 0, ?int $userCreateId = null)
    {
        $this->userId = $userId;
        $this->skillId = $skillId;
        $this->sparkSkillCount = $skillSparkCount;
        $this->userCreateId = $userCreateId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param  int  $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getSkillId(): int
    {
        return $this->skillId;
    }

    /**
     * @param  int  $skillId
     */
    public function setSkillId(int $skillId): void
    {
        $this->skillId = $skillId;
    }

    /**
     * @return int
     */
    public function getSparkSkillCount(): int
    {
        return $this->sparkSkillCount;
    }

    /**
     * @param  int  $sparkSkillCount
     */
    public function setSparkSkillCount(int $sparkSkillCount): void
    {
        $this->sparkSkillCount = $sparkSkillCount;
    }

    /**
     * @return Skill
     */
    public function getSkill(): Skill
    {
        return $this->skill;
    }

    /**
     * @param  Skill  $skill
     */
    public function setSkill(Skill $skill): void
    {
        $this->skill = $skill;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param  User  $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function addOneSpark(): void
    {
        $this->sparkSkillCount++;
    }

    /**
     * @return int|null
     */
    public function getUserCreateId(): ?int
    {
        return $this->userCreateId;
    }

    /**
     * @param  int|null  $userCreateId
     */
    public function setUserCreateId(?int $userCreateId): void
    {
        $this->userCreateId = $userCreateId;
    }

    /**
     * @return Collection
     */
    public function getSparkDetails(): Collection
    {
        return $this->sparkDetails;
    }

    /**
     * @param  Collection  $sparkDetails
     */
    public function setSparkDetails(Collection $sparkDetails): void
    {
        $this->sparkDetails = $sparkDetails;
    }


}
