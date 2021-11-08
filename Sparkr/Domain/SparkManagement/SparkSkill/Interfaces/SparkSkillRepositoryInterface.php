<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Interfaces;


use Illuminate\Support\Collection;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill;

interface SparkSkillRepositoryInterface
{
    public function getSparkSkillByUserId(int $id): Collection;

    public function getSparkSkillById(int $id): SparkSkill;

    public function save(SparkSkill $sparkSkill): SparkSkill;
}
