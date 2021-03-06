<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\Repository;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Interfaces\PersonalProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\PersonalProfile\Models\PersonalProfile;
use Sparkr\Domain\UserManagement\User\Models\User;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\PersonalProfile\ModelDao\PersonalProfile as PersonalProfileDao;

class PersonalProfileRepository extends EloquentBaseRepository implements PersonalProfileRepositoryInterface
{
    const LIST_LIMIT = 50;
    const RECOMMENDED_LIST_LIMIT = 20;
    const SIMILAR_LIST_LIMIT = 3;

    /**
     * ProfileRepository constructor.
     * @ PersonalProfileDao $model
     */
    public function __construct(PersonalProfileDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllPersonalProfile(): Collection
    {
        $query = $this->model->with([
            'user',
            'jobType',
        ])->get();
        return $this->transformCollection($query);
    }

    public function getRecommendPersonalProfileList(): Collection
    {
        $query = $this->createQuery()
            ->limit(self::RECOMMENDED_LIST_LIMIT)->get()->sortByDesc('user.spark_count');

        return $this->transformCollection($query);
    }

    public function getPersonalProfileList(): Collection
    {
        $query = $this->createQuery()
            ->limit(self::LIST_LIMIT)->get();

        return $this->transformCollection($query);
    }

    public function getSpecifiedPersonalProfile(array $params): Collection
    {
        $query = $this->createQuery();
        if (!empty($params['keyword'])) {
            $query = $query->whereHas('user', function ($query) use ($params) {
                $query->where('name', 'LIKE', '%'.$params['keyword'].'%')
                    ->orWhere('current_position', 'LIKE', '%'.$params['keyword'].'%')
                    ->orWhere('desired_position', 'LIKE', '%'.$params['keyword'].'%')
                    ->orWhere('about', 'LIKE', '%'.$params['keyword'].'%');
            });
        }

        $hasFilters = false;
        foreach ($params['filters'] as $column => $value) {
            if (!empty($value)) {
                $hasFilters = true;
                break;
            }
        }
        if ($hasFilters) {
            $query =  $query->join('users', 'users.id', '=', 'personal_profiles.user_id');
            foreach ($params['filters'] as $column => $value) {
                if (!empty($value)) {
                    $query->where($column, $value);
                }
            }
        }

        if (!empty($params['sparkr'])) {
            $query = $query->select('personal_profiles.*')
                ->join('sparks', 'sparks.user_id', '=', 'personal_profiles.user_id')
                ->join('skills', 'skills.id', '=', 'sparks.skill_id')
                ->where('skills.name', 'LIKE', '%'.$params['sparkr'].'%')
                ->orderBy('sparks.spark_count');
        }

        $eloquentModelCollection = $query->get();

        return $this->transformCollection($eloquentModelCollection);
    }


    /**
     */
    public function getById(int $id): PersonalProfile
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.personal_profile_not_found'));
    }

    /**
     */
    public function getByUserId(int $id): PersonalProfile
    {
        $query = $this->createQuery()->where('user_id', $id)->first();
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.personal_profile_not_found'));

    }

    /**
     * @throws \Exception
     */
    public function getDetailByUserId(int $id): PersonalProfile
    {
        $query = $this->createQuery()->with('user.socialLinks')
            ->where('user_id', $id)->first();
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.personal_profile_not_found'));

    }


    public function save(PersonalProfile $personalProfile): PersonalProfile
    {
        return $this->createModelDAO($personalProfile->getId())->saveData($personalProfile);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();
    }

    public function getSimilarPersonalProfileList(PersonalProfile $personalProfile): Collection
    {
        $query = $this->createQuery()
            ->limit(self::SIMILAR_LIST_LIMIT)
            ->whereHas('user', function ($query) use ($personalProfile) {
                $query->where('experience_level', 'LIKE', '%'.$personalProfile->getUser()->getExperienceLevel().'%')
                    ->orWhere('desired_position', 'LIKE', '%'.$personalProfile->getDesiredPosition().'%');
            });

        return $this->transformCollection($query->get());
    }

}
