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

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user', 'category'
    ];

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

        $companyProfile->setUser($this->user->toDomainEntity());
        $companyProfile->setCategory($this->category->toDomainEntity());
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
