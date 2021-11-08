<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobInterestedActivity\ModelDao;

use Sparkr\Domain\JobManagement\JobInterestedActivity\Models\JobInterestedActivity as JobDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class JobInterestedActivity extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_interested_activities';

    public function toDomainEntity(): JobDomainModel
    {
        $job = new JobDomainModel(
            $this->job_id,
            $this->personal_profile_id,
        );
        $job->setId($this->getKey());

        return $job;
    }

    /**
     * @param JobDomainModel $job
     * @return JobInterestedActivity
     */
    protected function fromDomainEntity($job)
    {
        $this->job_id = $job->getJobId();
        $this->personal_profile_id = $job->getPersonalProfileId();

        return $this;
    }

}
