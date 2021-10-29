<?php

namespace Sparkr\Domain\ProfileManagement\CompanyProfile\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class CompanyProfile extends BaseDomainModel
{
    private ?string $phone;

    private ?string $companyWebsiteUrl;

    private ?string $employeeBenefits;

    private ?int $categoryId;

    /**
     * CompanyProfile constructor.
     * @param  string|null  $phone
     * @param  string|null  $companyWebsiteUrl
     * @param  string|null  $employeeBenefits
     * @param  int|null  $categoryId
     */
    public function __construct(?string $phone, ?string $companyWebsiteUrl, ?string $employeeBenefits, ?int $categoryId)
    {
        $this->phone = $phone;
        $this->companyWebsiteUrl = $companyWebsiteUrl;
        $this->employeeBenefits = $employeeBenefits;
        $this->categoryId = $categoryId;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param  string|null  $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getCompanyWebsiteUrl(): ?string
    {
        return $this->companyWebsiteUrl;
    }

    /**
     * @param  string|null  $companyWebsiteUrl
     */
    public function setCompanyWebsiteUrl(?string $companyWebsiteUrl): void
    {
        $this->companyWebsiteUrl = $companyWebsiteUrl;
    }

    /**
     * @return string|null
     */
    public function getEmployeeBenefits(): ?string
    {
        return $this->employeeBenefits;
    }

    /**
     * @param  string|null  $employeeBenefits
     */
    public function setEmployeeBenefits(?string $employeeBenefits): void
    {
        $this->employeeBenefits = $employeeBenefits;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param  int|null  $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }


}
