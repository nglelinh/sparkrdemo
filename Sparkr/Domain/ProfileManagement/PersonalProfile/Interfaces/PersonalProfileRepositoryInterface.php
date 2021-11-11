<?php

namespace Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;

interface PersonalProfileRepositoryInterface
{
    /**
     */
    public function getAllPersonalProfile();

    /**
     */
    public function getRecommendPersonalProfileList(): Collection;

    public function getPersonalProfileList(): Collection;

    /**
     */
    public function getSpecifiedPersonalProfile(array $params): Collection;

    /**
     */
    public function getById(int $id);
    /**
     */
    public function getByUserId(int $id);

    /**
     */
    public function save(PersonalProfile $personalProfile);

    /**
     */
    public function delete(int $id);

    public function getDetailByUserId(int $id): PersonalProfile;

    public function getSimilarPersonalProfileList(PersonalProfile $personalProfile): Collection;

}
