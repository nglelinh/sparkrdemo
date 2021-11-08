<?php

namespace Sparkr\Domain\SparkManagement\SparkSkill\Services;



use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;

class SparkSkillDomainService
{
    private SparkSkillRepositoryInterface $sparkSkillRepository;

    public function __construct(
        SparkSkillRepositoryInterface $personalProfileRepository
    ) {
        $this->sparkSkillRepository = $personalProfileRepository;
    }

}
