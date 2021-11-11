<?php

namespace Sparkr\Domain\ProfileManagement\JobHistory\Models;

use Carbon\Carbon;
use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class JobHistory extends BaseDomainModel
{
    private int $personalProfileId;

    private string $title;

    private string $companyName;

    private Carbon $startDate;

    private Carbon $endDate;

    private string $description;

    private ?int $jobTypeId;

    private ?int $availability;

    /**
     * JobHistory constructor.
     * @param  int  $personalProfileId
     * @param  string  $title
     * @param  string  $companyName
     * @param  Carbon  $startDate
     * @param  Carbon  $endDate
     * @param  string  $description
     * @param  int|null  $jobTypeId
     * @param  int|null  $availability
     */
    public function __construct(
        int $personalProfileId,
        string $title,
        string $companyName,
        Carbon $startDate,
        Carbon $endDate,
        string $description,
        ?int $jobTypeId,
        ?int $availability
    ) {
        $this->personalProfileId = $personalProfileId;
        $this->title = $title;
        $this->companyName = $companyName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->jobTypeId = $jobTypeId;
        $this->availability = $availability;
    }

    /**
     * @return int
     */
    public function getPersonalProfileId(): int
    {
        return $this->personalProfileId;
    }

    /**
     * @param  int  $personalProfileId
     */
    public function setPersonalProfileId(int $personalProfileId): void
    {
        $this->personalProfileId = $personalProfileId;
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
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param  string  $companyName
     */
    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->startDate;
    }

    /**
     * @param  Carbon  $startDate
     */
    public function setStartDate(Carbon $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): Carbon
    {
        return $this->endDate;
    }

    /**
     * @param  Carbon  $endDate
     */
    public function setEndDate(Carbon $endDate): void
    {
        $this->endDate = $endDate;
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

}
