<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao;

use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile as CompanyProfileDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Traits\CompanyProfileRelationshipTrait;

class CompanyProfile extends BaseModel
{
    use CompanyProfileRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_profiles';

    public function toDomainEntity(): CompanyProfileDomainModel
    {
        $companyProfile = new CompanyProfileDomainModel(
            $this->phone,
            $this->company_website_url,
            $this->employee_benefits,
            $this->category_id,
        );
        $companyProfile->setId($this->getKey());

        if ($this->relationLoaded('category')) {
            $companyProfile->setCategory($this->category->toDomainEntity());
        }
        return $companyProfile;
    }

    /**
     * @param CompanyProfileDomainModel $companyProfile
     * @return CompanyProfile
     */
    protected function fromDomainEntity($companyProfile)
    {
        $this->phone = $companyProfile->getPhone();
        $this->company_website_url = $companyProfile->getCompanyWebsiteUrl();
        $this->employee_benefits = $companyProfile->getEmployeeBenefits();
        $this->category_id = $companyProfile->getCategoryId();

        return $this;
    }

}
