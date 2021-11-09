<?php

namespace Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;

interface CompanyProfileRepositoryInterface
{
    /**
     */
    public function getAllCompanyProfile();

    /**
     */
    public function getRecommendCompanyProfileList(): Collection;

    public function getCompanyProfileList(): Collection;

    /**
     */
    public function getSpecifiedCompanyProfile(array $params): Collection;

    /**
     */
    public function getById(int $id): CompanyProfile;

    /**
     */
    public function getByUserId(int $id): CompanyProfile;

    /**
     */
    public function save(CompanyProfile $companyProfile);

    /**
     */
    public function delete(int $id);

    public function getDetailByUserId(int $id): CompanyProfile;

}
