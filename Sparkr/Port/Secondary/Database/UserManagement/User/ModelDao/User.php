<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao;

use Illuminate\Support\Carbon;
use Sparkr\Domain\UserManagement\User\Models\User as UserDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class User extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function toDomainEntity(): UserDomainModel
    {
        $user = new UserDomainModel(
            $this->name,
            $this->email,
            $this->password,
            $this->user_type_id,
            $this->experience_level_id,
            $this->spark_count,
            $this->following_count,
            $this->followed_count,
            Carbon::make($this->last_login),
            $this->image,
            $this->status,
        );
        $user->setId($this->getKey());

        return $user;
    }

    /**
     * @param UserDomainModel $user
     * @return User
     */
    protected function fromDomainEntity($user)
    {
        $this->name = $user->getName();
        $this->email = $user->getEmail();
        $this->password = $user->getPassword();
        $this->user_type_id = $user->getUserTypeId();
        $this->experience_level_id = $user->getExperienceLevelId();
        $this->spark_count = $user->getSparkCount();
        $this->following_count = $user->getFollowingCount();
        $this->followed_count = $user->getFollowedCount();
        $this->last_login = $user->getLastLogin();
        $this->image = $user->getImage();
        $this->status = $user->getStatus();

        return $this;
    }

}
