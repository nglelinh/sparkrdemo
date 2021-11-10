<?php

namespace Sparkr\Domain\ProfileManagement\PersonalProfile\Services;

//use Sparkr\Domain\Base\Exception\BaseValidationException;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;

class PersonalProfileDomainService
{
    private PersonalProfileRepositoryInterface $personalProfileRepository;

    public function __construct(
        PersonalProfileRepositoryInterface $personalProfileRepository
    ) {
        $this->personalProfileRepository = $personalProfileRepository;
    }

    // Get current position as latest job's name
    public function getCurrentJob(Collection $jobHistory): string
    {
        $jobName = '';
        $latestJobDate = $jobHistory->first()->getEndDate();
        foreach ($jobHistory as $job){
            $jobEndDate = $job->getEndDate();
            if ($jobEndDate->greaterThan($latestJobDate)){
                $latestJobDate = $jobEndDate;
                $jobName = $job->getTitle();
            }
        }
        return $jobName;
    }

}
