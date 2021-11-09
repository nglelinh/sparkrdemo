<?php

namespace Sparkr\Domain\JobManagement\JobApplyActivity\Interfaces;


use Sparkr\Domain\JobManagement\JobApplyActivity\Models\JobApplyActivity;

interface JobApplyActivityRepositoryInterface
{
    public function save(JobApplyActivity $jobApplyActivity);

}
