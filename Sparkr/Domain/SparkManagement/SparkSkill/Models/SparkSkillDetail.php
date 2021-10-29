<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class SparkSkillDetail extends BaseDomainModel
{
    private int $sparkSkillId;

    private int $companyProfileId;

    /**
     * SparkSkillDetail constructor.
     * @param  int  $sparkSkillId
     * @param  int  $companyProfileId
     */
    public function __construct(int $sparkSkillId, int $companyProfileId)
    {
        $this->sparkSkillId = $sparkSkillId;
        $this->companyProfileId = $companyProfileId;
    }

    /**
     * @return int
     */
    public function getSparkSkillId(): int
    {
        return $this->sparkSkillId;
    }

    /**
     * @param  int  $sparkSkillId
     */
    public function setSparkSkillId(int $sparkSkillId): void
    {
        $this->sparkSkillId = $sparkSkillId;
    }

    /**
     * @return int
     */
    public function getCompanyProfileId(): int
    {
        return $this->companyProfileId;
    }

    /**
     * @param  int  $companyProfileId
     */
    public function setCompanyProfileId(int $companyProfileId): void
    {
        $this->companyProfileId = $companyProfileId;
    }



}
