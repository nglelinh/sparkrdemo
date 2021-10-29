<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class SparkSkill extends BaseDomainModel
{
    private int $personalProfileId;

    private int $skillId;

    private int $sparkSkillCount;

    /**
     * SparkSkill constructor.
     * @param  int  $personalProfileId
     * @param  int  $skillId
     * @param  int  $skillSparkCount
     */
    public function __construct(int $personalProfileId, int $skillId, int $skillSparkCount = 0)
    {
        $this->personalProfileId = $personalProfileId;
        $this->skillId = $skillId;
        $this->sparkSkillCount = $skillSparkCount;
    }

    /**
     * @return int
     */
    public function getPersonalProfileId(): int
    {
        return $this->personalProfileId;
    }

    /**
     * @param  int  $personalProfileId
     */
    public function setPersonalProfileId(int $personalProfileId): void
    {
        $this->personalProfileId = $personalProfileId;
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

}
