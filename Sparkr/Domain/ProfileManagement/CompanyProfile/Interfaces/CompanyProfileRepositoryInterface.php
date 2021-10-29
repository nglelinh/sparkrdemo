<?php

namespace Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces;


use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;

interface CompanyProfileRepositoryInterface
{
    /**
     */
    public function index();

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(CompanyProfile $companyProfile);

    /**
     */
    public function delete(int $id);


}
