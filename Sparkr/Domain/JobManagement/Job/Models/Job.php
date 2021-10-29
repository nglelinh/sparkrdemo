<?php

namespace Sparkr\Domain\JobManagement\Job\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Utility\Enums\Status;

/**
 *
 */
class Job extends BaseDomainModel
{
    private string $title;

    private int $companyProfileId;

    private ?int $jobTypeId;

    private ?int $availabilityId;

    private string $description;

    private int $status;

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
        ?int $jobTypeId,
        ?int $availabilityId,
        string $description,
        int $status = Status::Active
    ) {
        $this->title = $title;
        $this->companyProfileId = $companyProfileId;
        $this->jobTypeId = $jobTypeId;
        $this->availabilityId = $availabilityId;
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
    public function getAvailabilityId(): ?int
    {
        return $this->availabilityId;
    }

    /**
     * @param  int|null  $availabilityId
     */
    public function setAvailabilityId(?int $availabilityId): void
    {
        $this->availabilityId = $availabilityId;
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


}
