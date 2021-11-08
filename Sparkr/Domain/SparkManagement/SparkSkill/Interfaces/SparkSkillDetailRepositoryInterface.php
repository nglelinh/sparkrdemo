<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Interfaces;



use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkillDetail;

interface SparkSkillDetailRepositoryInterface
{
    public function save(SparkSkillDetail $sparkSkillDetail): SparkSkillDetail;

}
