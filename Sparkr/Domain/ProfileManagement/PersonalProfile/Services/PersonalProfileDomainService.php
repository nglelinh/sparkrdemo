<?php

namespace Sparkr\Domain\ProfileManagement\PersonalProfile\Services;

//use Sparkr\Domain\Base\Exception\BaseValidationException;


use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;

class PersonalProfileDomainService
{
    private PersonalProfileRepositoryInterface $personalProfileRepository;

    public function __construct(
        PersonalProfileRepositoryInterface $personalProfileRepository
    ) {
        $this->personalProfileRepository = $personalProfileRepository;
    }

    public function getRecommendedPersonalProfile()
    {
        $result = $this->personalProfileRepository->getRecommendPersonalProfile();
        return $result;
    }

}
