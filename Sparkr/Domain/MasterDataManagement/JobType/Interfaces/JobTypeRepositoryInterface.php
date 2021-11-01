<?php

namespace Sparkr\Domain\MasterDataManagement\JobType\Interfaces;


use Sparkr\Domain\MasterDataManagement\JobType\Models\JobType;

interface JobTypeRepositoryInterface
{
    /**
     */
    public function getAllJobType();

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(JobType $jobType);

    /**
     */
    public function delete(int $id);


}
