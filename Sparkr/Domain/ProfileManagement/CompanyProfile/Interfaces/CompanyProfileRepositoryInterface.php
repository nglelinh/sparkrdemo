<?php

namespace Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces;


use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;

interface CompanyProfileRepositoryInterface
{
    /**
     */
    public function getAllCompanyProfile();

    /**
     */
    public function getById(int $id): CompanyProfile;

    /**
     */
    public function save(CompanyProfile $companyProfile);

    /**
     */
    public function delete(int $id);


}
