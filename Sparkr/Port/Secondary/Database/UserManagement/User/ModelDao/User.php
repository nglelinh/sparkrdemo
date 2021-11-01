<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\User\ModelDao;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Carbon;
use Sparkr\Domain\UserManagement\User\Models\User as UserDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Sparkr\Port\Secondary\Database\UserManagement\User\Traits\UserRelationshipTrait;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use  UserRelationshipTrait, Notifiable, HasApiTokens;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function toDomainEntity(): UserDomainModel
    {
        $user = new UserDomainModel(
            $this->email,
            $this->password,
            $this->name,
            $this->user_type_id,
            $this->experience_level_id,
            $this->location_id,
            $this->spark_count,
            $this->following_count,
            $this->followed_count,
            Carbon::make($this->last_login),
            $this->image,
            $this->status,
        );
        $user->setId($this->getKey());

        if ($this->relationLoaded('location')) {
            $user->setLocation($this->location->toDomainEntity());
        }

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
        $this->location_id = $user->getLocationId();
        $this->spark_count = $user->getSparkCount();
        $this->following_count = $user->getFollowingCount();
        $this->followed_count = $user->getFollowedCount();
        $this->last_login = $user->getLastLogin();
        $this->image = $user->getImage();
        $this->status = $user->getStatus();

        return $this;
    }

}
