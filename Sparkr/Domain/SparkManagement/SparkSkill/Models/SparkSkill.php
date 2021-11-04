<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;

/**
 *
 */
class SparkSkill extends BaseDomainModel
{
    private int $personalProfileId;

    private int $skillId;

    private int $sparkSkillCount;

    private Skill $skill;

    private PersonalProfile $personalProfile;

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
     * @return PersonalProfile
     */
    public function getPersonalProfile(): PersonalProfile
    {
        return $this->personalProfile;
    }

    /**
     * @param  PersonalProfile  $personalProfile
     */
    public function setPersonalProfile(PersonalProfile $personalProfile): void
    {
        $this->personalProfile = $personalProfile;
    }

}
