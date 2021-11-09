<?php

namespace Sparkr\Domain\JobManagement\Job\Interfaces;


use Illuminate\Support\Collection;
use Sparkr\Domain\JobManagement\Job\Models\Job;

interface JobRepositoryInterface
{
    /**
     */
    public function getAllJob();

    /**
     */
    public function getById(int $id): Job;

    /**
     */
    public function save(Job $job);

    /**
     */
    public function delete(int $id);

    public function getShortJobListByCompanyProfileId(int $id): Collection;

    public function getAllJobsByCompanyProfileId(int $id): Collection;

    public function getJobAndActivitiesByCompanyProfileId(int $id): Collection;



}
