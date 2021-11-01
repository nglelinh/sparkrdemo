<?php

namespace Sparkr\Domain\ProfileManagement\CompanyProfile\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\Category\Models\Category;
use Sparkr\Domain\UserManagement\User\Models\User;

/**
 *
 */
class CompanyProfile extends BaseDomainModel
{
    private ?int $userId;

    private ?string $phone;

    private ?string $companyWebsiteUrl;

    private ?string $employeeBenefits;

    private ?int $categoryId;

    private ?Category $category;

    private ?User $user;
    /**
     * CompanyProfile constructor.
     * @param  int|null  $userId
     * @param  string|null  $phone
     * @param  string|null  $companyWebsiteUrl
     * @param  string|null  $employeeBenefits
     * @param  int|null  $categoryId
     */
    public function __construct(
        ?int $userId,
        ?int $categoryId,
        ?string $phone =null,
        ?string $companyWebsiteUrl=null,
        ?string $employeeBenefits=null,
) {
        $this->userId = $userId;
        $this->phone = $phone;
        $this->companyWebsiteUrl = $companyWebsiteUrl;
        $this->employeeBenefits = $employeeBenefits;
        $this->categoryId = $categoryId;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param  int|null  $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
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

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param  Category|null  $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param  User|null  $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


}
