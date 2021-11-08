<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\JobApplyActivity\ModelDao;

use Sparkr\Domain\JobManagement\JobApplyActivity\Models\JobApplyActivity as JobDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class JobApplyActivity extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_apply_activities';

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
     * @return JobApplyActivity
     */
    protected function fromDomainEntity($job)
    {
        $this->job_id = $job->getJobId();
        $this->personal_profile_id = $job->getPersonalProfileId();

        return $this;
    }

}
