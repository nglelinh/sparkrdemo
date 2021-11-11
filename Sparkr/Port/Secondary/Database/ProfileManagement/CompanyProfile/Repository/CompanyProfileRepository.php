<?php

namespace Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\Repository;


use Illuminate\Support\Collection;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Interfaces\CompanyProfileRepositoryInterface;
use Sparkr\Domain\ProfileManagement\CompanyProfile\Models\CompanyProfile;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;
use Sparkr\Port\Secondary\Database\ProfileManagement\CompanyProfile\ModelDao\CompanyProfile as CompanyProfileDao;
use Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao\User;

class CompanyProfileRepository extends EloquentBaseRepository implements CompanyProfileRepositoryInterface
{
    const LIST_LIMIT = 50;
    const RECOMMENDED_LIST_LIMIT = 20;
    const SIMILAR_LIST_LIMIT = 3;

    /**
     * ProfileRepository constructor.
     * @param CompanyProfileDao $model
     */
    public function __construct(CompanyProfileDao $model)
    {
        parent::__construct($model);
    }

    /**
     */
    public function getAllCompanyProfile()
    {
        $query = $this->model->with([
            'user',
            'category'
        ])->get();
        return $this->transformCollection($query);
    }

    /**
     */
    public function getById(int $id): CompanyProfile
    {
        $query = $this->createQuery()->find($id);
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.company_not_found'));
    }

    public function save(CompanyProfile $companyProfile): CompanyProfile
    {
        return $this->createModelDAO($companyProfile->getId())->saveData($companyProfile);
    }

    public function delete(int $id)
    {
        return $this->createQuery()->where('id', $id)->delete();


    }

    public function getRecommendCompanyProfileList(): Collection
    {
        $query = $this->createQuery()
            ->limit(self::RECOMMENDED_LIST_LIMIT)
            ->with('user.location')
            ->get()->sortByDesc('user.spark_count');

        return $this->transformCollection($query);
    }

    public function getCompanyProfileList(): Collection
    {
        $query = $this->createQuery()
            ->with('user.location')
            ->limit(self::LIST_LIMIT)->get();

        return $this->transformCollection($query);
    }

    public function getSpecifiedCompanyProfile(array $params): Collection
    {
        $query = $this->createQuery();
        if (!empty($params['keyword'])) {
            $query = $query->whereHas('user', function ($query) use ($params) {
                $query->where('name', 'LIKE', '%'.$params['keyword'].'%')
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
            $query =  $query->join('users', 'users.id', '=', 'company_profiles.user_id');
            foreach ($params['filters'] as $column => $value) {
                if (!empty($value)) {
                    $query->where($column, $value);
                }
            }
        }

        if (!empty($params['sparkr'])) {
            $query = $query->select('company_profiles.*')
                ->join('sparks', 'sparks.user_id', '=', 'company_profiles.user_id')
                ->join('skills', 'skills.id', '=', 'sparks.skill_id')
                ->where('skills.name', 'LIKE', '%'.$params['sparkr'].'%')
                ->orderBy('sparks.spark_count')
                ->with('user.location');
        }

        $eloquentModelCollection = $query->get();

        return $this->transformCollection($eloquentModelCollection);
    }

    public function getByUserId(int $id): CompanyProfile
    {
        $query = $this->createQuery()->where('user_id', $id)->first();
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.company_not_found'));
    }

    public function getDetailByUserId(int $id): CompanyProfile
    {
        $query = $this->createQuery()->with(['user.socialLinks', 'user.location'])
            ->where('user_id', $id)->first();
        if ($query) {
            return $query->toDomainEntity();
        }
        throw new \Exception(__('admin_messages.company_not_found'));
    }

    public function getSimilarCompanyProfileList(CompanyProfile $companyProfile): Collection
    {
        $query = $this->createQuery()
            ->with('user.location')
            ->limit(self::SIMILAR_LIST_LIMIT)
            ->whereHas('user', function ($query) use ($companyProfile) {
                $query->where('experience_level', 'LIKE', '%'.$companyProfile->getUser()->getExperienceLevel().'%')
                    ->orWhere('category_id', 'LIKE', '%'.$companyProfile->getCategoryId().'%');
            });

        return $this->transformCollection($query->get());
    }

}
