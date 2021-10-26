<?php

namespace Sparkr\Domain\MasterDataManagement\Skill\Interfaces;

use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill as SkillDomainModel;
use Illuminate\Support\Collection;

interface SkillRepositoryInterface
{
    /**
     * Get All Skills
     *
     * @return Collection
     */
    public function getAllSkills(string $skill_name = ""): Collection;

    /**
     * Get Skill By ID
     *
     * @return Array
     */
    public function getSkillById(int $id): SkillDomainModel;

    /**
     * save
     *
     * @return Skill
     */
    public function save(Skill $skill): Skill;

    /**
     * @param $skillName
     * @return SkillDomainModel|null
     */
    public function getSkillBySkillName($skillName): ?Skill;
}
