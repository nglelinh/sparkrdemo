<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile as PersonalProfileDao;

class PersonalProfileRepository extends EloquentBaseRepository implements PersonalProfileRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param PersonalProfileDao $model
     */
    public function __construct(PersonalProfileDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllPersonalProfile(): Collection
    {
        $query = $this->model->with([
            'user',
            'jobType',
        ])->get();
        return $this->transformCollection($query);
    }

    /**
     */
    public function getById(int $id): PersonalProfile
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.company_not_found'));
    }

    public function save(PersonalProfile $personalProfile): PersonalProfile
    {
        return $this->createModelDAO($personalProfile->getId())->saveData($personalProfile);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}
