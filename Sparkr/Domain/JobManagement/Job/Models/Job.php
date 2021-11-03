<?php

namespace Sparkr\Domain\JobManagement\Job\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Sparkr\Utility\Enums\Status;

/**
 *
 */
class Job extends BaseDomainModel
{
    private string $title;

    private int $companyProfileId;

    private ?int $jobTypeId;

    private ?int $availability;

    private string $description;

    private int $status;

    private JobType $jobType;

    private CompanyProfile $companyProfile;



    /**
     * Job constructor.
     * @param  string  $title
     * @param  int  $companyProfileId
     * @param  int|null  $jobTypeId
     * @param  int|null  $availabilityId
     * @param  string  $description
     * @param  int  $status
     */
    public function __construct(
        string $title,
        int $companyProfileId,
        string $description,
        ?int $jobTypeId = null,
        ?int $availabilityId = null,
        int $status = Status::Active
    ) {
        $this->title = $title;
        $this->companyProfileId = $companyProfileId;
        $this->jobTypeId = $jobTypeId;
        $this->availability = $availabilityId;
        $this->description = $description;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param  string  $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getCompanyProfileId(): int
    {
        return $this->companyProfileId;
    }

    /**
     * @param  int  $companyProfileId
     */
    public function setCompanyProfileId(int $companyProfileId): void
    {
        $this->companyProfileId = $companyProfileId;
    }

    /**
     * @return int|null
     */
    public function getJobTypeId(): ?int
    {
        return $this->jobTypeId;
    }

    /**
     * @param  int|null  $jobTypeId
     */
    public function setJobTypeId(?int $jobTypeId): void
    {
        $this->jobTypeId = $jobTypeId;
    }

    /**
     * @return int|null
     */
    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    /**
     * @param  int|null  $availability
     */
    public function setAvailability(?int $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param  int  $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return JobType
     */
    public function getJobType(): JobType
    {
        return $this->jobType;
    }

    /**
     * @param  JobType  $jobType
     */
    public function setJobType(JobType $jobType): void
    {
        $this->jobType = $jobType;
    }

    /**
     * @return CompanyProfile
     */
    public function getCompanyProfile(): CompanyProfile
    {
        return $this->companyProfile;
    }

    /**
     * @param  CompanyProfile  $companyProfile
     */
    public function setCompanyProfile(CompanyProfile $companyProfile): void
    {
        $this->companyProfile = $companyProfile;
    }


}
