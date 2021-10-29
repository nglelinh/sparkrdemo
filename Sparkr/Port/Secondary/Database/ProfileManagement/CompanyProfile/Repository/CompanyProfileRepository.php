<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Repository;


use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao\CompanyProfile as CompanyProfileDao;

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

}
