<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\MasterDataManagement\Skill\Interfaces\SkillRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill as SkillDao;

class SkillRepository extends EloquentBaseRepository implements SkillRepositoryInterface
{

    /**
     * SkillRepository constructor.
     * @param SkillDao $model
     */
    public function __construct(SkillDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllSkill(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): Skill
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(Skill $skill): Skill
    {
        return $this->createModelDAO($skill->getId())->saveData($skill);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}
