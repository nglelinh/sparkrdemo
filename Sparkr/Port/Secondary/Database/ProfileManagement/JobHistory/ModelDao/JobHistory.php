<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\JobHistory\ModelDao;

use Carbon\Carbon;
use Sparkr\Domain\ProfileManagement\JobHistory\Models\JobHistory as JobHistoryDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class JobHistory extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_history';

    public function toDomainEntity(): JobHistoryDomainModel
    {
        $jobHistory = new JobHistoryDomainModel(
            $this->personal_profile_id,
            $this->title,
            $this->company_name,
            Carbon::make($this->start_date),
            Carbon::make($this->end_date),
            $this->description,
            $this->job_type_id,
            $this->availability,
        );
        $jobHistory->setId($this->getKey());

        return $jobHistory;
    }

    /**
     * @param JobHistoryDomainModel $jobHistory
     * @return JobHistory
     */
    protected function fromDomainEntity($jobHistory)
    {
        $this->personal_profile_id = $jobHistory->getPersonalProfileId();
        $this->title = $jobHistory->getTitle();
        $this->company_name = $jobHistory->getCompanyName();
        $this->start_date = $jobHistory->getStartDate();
        $this->end_date = $jobHistory->getEndDate();
        $this->description = $jobHistory->getDescription();
        $this->job_type_id = $jobHistory->getJobTypeId();
        $this->availability = $jobHistory->getAvailabilityId();

        return $this;
    }

}
