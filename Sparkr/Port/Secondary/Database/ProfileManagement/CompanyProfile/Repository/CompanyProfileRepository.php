<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao\CompanyProfile as CompanyProfileDao;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;

class CompanyProfileRepository extends EloquentBaseRepository implements CompanyProfileRepositoryInterface
{

    /**
     * ProfileRepository constructor.
     * @param CompanyProfileDao $model
     */
    public function __construct(CompanyProfileDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllCompanyProfile()
    {
        $query = $this->model->with([
            'user',
            'category'
        ])->get();
        return $this->transformCollection($query);
    }

    /**
     */
    public function getById(int $id): CompanyProfile
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.company_not_found'));
    }

    public function save(CompanyProfile $companyProfile): CompanyProfile
    {
        return $this->createModelDAO($companyProfile->getId())->saveData($companyProfile);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }
}
