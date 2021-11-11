<?php

namespace Sparkr\Domain\JobManagement\JobInterestedActivity\Interfaces;


use Sparkr\Domain\JobManagement\JobInterestedActivity\Models\JobInterestedActivity;

interface JobInterestedActivityRepositoryInterface
{
    public function save(JobInterestedActivity $jobInterestedActivity);

}
