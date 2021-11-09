<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\Job\ModelDao;

use Sparkr\Domain\JobManagement\Job\Models\Job as JobDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\JobManagement\Job\Traits\JobRelationshipTrait;

class Job extends BaseModel
{
    use JobRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    public function toDomainEntity(): JobDomainModel
    {
        $job = new JobDomainModel(
            $this->title,
            $this->company_profile_id,
            $this->description,
            $this->job_type_id,
            $this->availability,
            $this->status,
        );
        $job->setId($this->getKey());

        if ($this->relationLoaded('jobType')) {
            $job->setJobType($this->jobType->toDomainEntity());
        }
        if ($this->relationLoaded('companyProfile')) {
            $job->setCompanyProfile($this->companyProfile->toDomainEntity());
        }
        if ($this->relationLoaded('jobApplyActivities')) {
            $job->setJobApplyActivities($this->jobApplyActivities?->map(function ($job) {
                return $job->toDomainEntity();
            }));
        }
        if ($this->relationLoaded('jobInterestedActivities')) {
            $job->setJobInterestedActivities($this->jobInterestedActivities?->map(function ($job) {
                return $job->toDomainEntity();
            }));
        }
        return $job;
    }

    /**
     * @param JobDomainModel $job
     * @return Job
     */
    protected function fromDomainEntity($job)
    {
        $this->title = $job->getTitle();
        $this->company_profile_id = $job->getCompanyProfileId();
        $this->job_type_id = $job->getJobTypeId();
        $this->availability = $job->getAvailability();
        $this->description = $job->getDescription();
        $this->status = $job->getStatus();

        return $this;
    }

}
