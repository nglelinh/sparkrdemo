<?php

namespace Sparkr\Domain\ProfileManagement\JobHistory\Interfaces;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\JobHistory\Models\JobHistory;

interface JobHistoryRepositoryInterface
{
    /**
     */
    public function getShortJobHistoryByPersonalProfileId(int $id): Collection;

    /**
     */
    public function getAllJobHistoryByPersonalProfileId(int $id): Collection;

    /**
     */
    public function save(JobHistory $jobHistory);
}
