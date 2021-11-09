<?php

namespace Sparkr\Domain\JobManagement\JobInterestedActivity\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;

/**
 *
 */
class JobInterestedActivity extends BaseDomainModel
{
    private int $jobId;

    private int $personalProfileId;

    private PersonalProfile $personalProfile;

    /**
     * JobApplyActivity constructor.
     * @param  int  $jobId
     * @param  int  $personalProfileId
     */
    public function __construct(int $jobId, int $personalProfileId)
    {
        $this->jobId = $jobId;
        $this->personalProfileId = $personalProfileId;
    }

    /**
     * @return int
     */
    public function getJobId(): int
    {
        return $this->jobId;
    }

    /**
     * @param  int  $jobId
     */
    public function setJobId(int $jobId): void
    {
        $this->jobId = $jobId;
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
     * @return PersonalProfile
     */
    public function getPersonalProfile(): PersonalProfile
    {
        return $this->personalProfile;
    }

    /**
     * @param  PersonalProfile  $personalProfile
     */
    public function setPersonalProfile(PersonalProfile $personalProfile): void
    {
        $this->personalProfile = $personalProfile;
    }


}
