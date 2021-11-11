<?php

namespace Sparkr\Port\Secondary\Database\JobManagement\Job\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\JobManagement\Job\Interfaces\JobRepositoryInterface;
use Sparkr\Domain\JobManagement\Job\Models\Job;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\JobManagement\Job\ModelDao\Job as JobDao;
use Sparkr\Utility\Enums\Status;

class JobRepository extends EloquentBaseRepository implements JobRepositoryInterface
{
    const DEFAULT_SHORT_LIMIT = 3;
    /**
     * JobRepository constructor.
     * @param JobDao $model
     */
    public function __construct(JobDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllJob(): Collection
    {
        $query = $this->model->with([
            'companyProfile.user',
            'jobType'
        ])->get();
        return $this->transformCollection($query);
    }

    /**
     */
    public function getById(int $id): Job
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.job_not_found'));
    }

    /**
     */
    public function getJobById(int $id): Job
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.job_not_found'));
    }

    public function save(Job $job): Job
    {
        return $this->createModelDAO($job->getId())->saveData($job);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();
    }

    public function getShortJobListByCompanyProfileId(int $id): Collection
    {
        return $this->transformCollection($this->createQuery()
            ->where('company_profile_id', $id)
            ->limit(self::DEFAULT_SHORT_LIMIT)->get());
    }

    public function getAllJobsByCompanyProfileId(int $id): Collection
    {
        return $this->transformCollection($this->createQuery()
            ->where('company_profile_id', $id)
            ->where('status', Status::Active)
            ->get());
    }

    public function getJobAndActivitiesByCompanyProfileId(int $id): Collection
    {
        $query = $this->createQuery()
            ->with(['jobApplyActivities', 'jobApplyActivities.personalProfile',
                'jobInterestedActivities', 'jobInterestedActivities.personalProfile'])
            ->where('company_profile_id', $id)->get();
        return $this->transformCollection($query);
    }

}
