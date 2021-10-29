<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao;

use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile as PersonalProfileDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class PersonalProfile extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personal_profiles';

    public function toDomainEntity(): PersonalProfileDomainModel
    {
        $personalProfile = new PersonalProfileDomainModel(
            $this->about,
            $this->desired_position,
            $this->education,
            $this->job_type_id,
            $this->availability_id,
        );
        $personalProfile->setId($this->getKey());

        return $personalProfile;
    }

    /**
     * @param PersonalProfileDomainModel $personalProfile
     * @return PersonalProfile
     */
    protected function fromDomainEntity($personalProfile)
    {
        $this->about = $personalProfile->getAbout();
        $this->desired_position = $personalProfile->getDesiredPosition();
        $this->education = $personalProfile->getEducation();
        $this->job_type_id = $personalProfile->getJobTypeId();
        $this->availability_id = $personalProfile->getAvailabilityId();

        return $this;
    }

}
