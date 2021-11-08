<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class SparkSkillDetail extends BaseDomainModel
{
    private int $sparkSkillId;

    private int $sparkFromUserId;

    /**
     * SparkSkillDetail constructor.
     * @param  int  $sparkSkillId
     * @param  int  $sparkFromUserId
     */
    public function __construct(int $sparkSkillId, int $sparkFromUserId)
    {
        $this->sparkSkillId = $sparkSkillId;
        $this->sparkFromUserId = $sparkFromUserId;
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
    public function getSparkFromUserId(): int
    {
        return $this->sparkFromUserId;
    }

    /**
     * @param  int  $sparkFromUserId
     */
    public function setSparkFromUserId(int $sparkFromUserId): void
    {
        $this->sparkFromUserId = $sparkFromUserId;
    }



}
