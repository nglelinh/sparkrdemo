<?php

namespace Sparkr\Domain\JobManagement\Job\Interfaces;


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


}
