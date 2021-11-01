<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Trait\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\MasterDataManagement\Trait\Interfaces\TraitRepositoryInterface;
use Sparkr\Domain\MasterDataManagement\Trait\Models\TraitModel;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Trait\ModelDao\TraitModel as TraitDao;

class TraitRepository extends EloquentBaseRepository implements TraitRepositoryInterface
{

    /**
     * TraitRepository constructor.
     * @param TraitDao $model
     */
    public function __construct(TraitDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllTrait(): Collection
    {
        return $this->getAll();
    }

    /**
     */
    public function getById(int $id): TraitModel
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.category_not_found'));
    }

    public function save(TraitModel $traitModel): TraitModel
    {
        return $this->createModelDAO($traitModel->getId())->saveData($traitModel);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}
