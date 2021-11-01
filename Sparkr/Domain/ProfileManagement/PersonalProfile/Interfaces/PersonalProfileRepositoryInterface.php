<?php

namespace Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces;


use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;

interface PersonalProfileRepositoryInterface
{
    /**
     */
    public function getAllPersonalProfile();

    /**
     */
    public function getById(int $id);

    /**
     */
    public function save(PersonalProfile $personalProfile);

    /**
     */
    public function delete(int $id);


}
