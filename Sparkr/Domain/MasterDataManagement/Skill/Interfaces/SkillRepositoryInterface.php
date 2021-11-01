<?php

namespace Sparkr\Domain\MasterDataManagement\Skill\Interfaces;


use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;

interface SkillRepositoryInterface
{
    /**
     */
    public function getAllSkill();

    /**
     */
    public function getById(int $id): Skill;

    /**
     */
    public function save(Skill $skill);

    /**
     */
    public function delete(int $id);


}
