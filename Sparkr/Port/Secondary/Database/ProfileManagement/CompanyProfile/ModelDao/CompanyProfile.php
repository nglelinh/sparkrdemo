<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao;

use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile as CompanyProfileDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Category\ModelDao\Category;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Traits\CompanyProfileRelationshipTrait;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;

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
            $this->user_id,
            $this->phone,
            $this->company_website_url,
            $this->employee_benefits,
            $this->category_id,
        );
        $companyProfile->setId($this->getKey());

        if ($this->relationLoaded('user')) {
            $companyProfile->setUser($this->user->toDomainEntity());
        }
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
        $this->user_id = $companyProfile->getUserId();
        $this->phone = $companyProfile->getPhone();
        $this->company_website_url = $companyProfile->getCompanyWebsiteUrl();
        $this->employee_benefits = $companyProfile->getEmployeeBenefits();
        $this->category_id = $companyProfile->getCategoryId();

        return $this;
    }

}
