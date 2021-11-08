<?php

namespace Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\SparkManagement\SparkSkill\Interfaces\SparkSkillRepositoryInterface;
use Sparkr\Domain\SparkManagement\SparkSkill\Models\SparkSkill;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\SparkManagement\SparkSkill\ModelDao\SparkSkill as SparkSkillDao;

class SparkSkillRepository extends EloquentBaseRepository implements SparkSkillRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param SparkSkillDao $model
     */
    public function __construct(SparkSkillDao $model)
    {
        parent::__construct($model);
    }

    public function getSparkSkillByUserId(int $id): Collection
    {
        $query = $this->createQuery()
            ->with(['skill', 'sparkDetails'])
            ->where('user_id', $id)->get();
        return $this->transformCollection($query);
    }

    public function getSparkSkillById(int $id): SparkSkill
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.job_not_found'));
    }

    public function save(SparkSkill $sparkSkill): SparkSkill
    {
        return $this->createModelDAO($sparkSkill->getId())->saveData($sparkSkill);
    }
}
