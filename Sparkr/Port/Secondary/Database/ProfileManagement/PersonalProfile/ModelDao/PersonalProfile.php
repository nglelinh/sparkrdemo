<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao;

use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile as PersonalProfileDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Traits\PersonalProfileRelationshipTrait;

class PersonalProfile extends BaseModel
{
    use PersonalProfileRelationshipTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personal_profiles';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user'
    ];

    public function toDomainEntity(): PersonalProfileDomainModel
    {
        $personalProfile = new PersonalProfileDomainModel(
            $this->user_id,
            $this->desired_position,
            $this->current_position,
            $this->about,
            $this->education,
            $this->job_type_id,
            $this->availability,
            $this->current_position,
        );
        $personalProfile->setId($this->getKey());

        $personalProfile->setUser($this->user->toDomainEntity());

        if ($this->relationLoaded('jobType')) {
            $personalProfile->setJobType($this->jobType?->toDomainEntity());
        }
        return $personalProfile;
    }

    /**
     * @param PersonalProfileDomainModel $personalProfile
     * @return PersonalProfile
     */
    protected function fromDomainEntity($personalProfile)
    {
        $this->user_id = $personalProfile->getUserId();
        $this->about = $personalProfile->getAbout();
        $this->desired_position = $personalProfile->getDesiredPosition();
        $this->current_position = $personalProfile->getCurrentPosition();
        $this->education = $personalProfile->getEducation();
        $this->job_type_id = $personalProfile->getJobTypeId();
        $this->availability = $personalProfile->getAvailabilityId();

        return $this;
    }

}
