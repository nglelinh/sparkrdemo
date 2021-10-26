<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Repository;

use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill as SkillDomainEntity;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Illuminate\Support\Collection;

class EloquentSkillRepository extends EloquentBaseRepository implements SkillRepositoryInterface
{
    /**
     * EloquentSkillRepository constructor.
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        parent::__construct($skill);
    }

    /**
     * Get All Skill
     *
     * @return Array
     */
    public function getAllSkills(string $skill_name = "", int $education_group = null): Collection
    {
        $query = $this->createQuery();
        if (!empty($skill_name)) {
            $query->where('skill_name', 'like', '%' . $skill_name . '%');
        }

        return $this->transformCollection($query->get());
    }

    /**
     * Get Skill By ID
     *
     * @return Array
     */
    public function getSkillById(int $id): SkillDomainEntity
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.skill_not_found'));
    }

    public function save(SkillDomainEntity $skill): SkillDomainEntity
    {
        return $this->createModelDAO($skill->getId())->saveData($skill);
    }

    public function getSkillBySkillName($skillName): ?SkillDomainEntity
    {
        $skill = $this->createQuery()->where('skill_name', $skillName)->first();

        return $skill?->toDomainEntity();
    }
}
