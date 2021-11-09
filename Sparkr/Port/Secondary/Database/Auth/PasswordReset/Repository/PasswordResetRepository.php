<?php

namespace Sparkr\Port\Secondary\Database\Auth\PasswordReset\Repository;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sparkr\Domain\Auth\ResetPassword\Interfaces\PasswordResetRepositoryInterface;
use Sparkr\Domain\Auth\ResetPassword\Models\PasswordReset;
use Sparkr\Port\Secondary\Database\Auth\PasswordReset\ModelDao\PasswordReset as PasswordResetDAO;
use Sparkr\Port\Secondary\Database\Base\EloquentBaseRepository;

class PasswordResetRepository extends EloquentBaseRepository implements PasswordResetRepositoryInterface
{

    /**
     * @param PasswordResetDAO $model
     */
    public function __construct(PasswordResetDAO $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $token
     * @return PasswordReset|null
     */
    public function getByToken(string $token): ?PasswordReset
    {
        $query = $this->createQuery()->where('token', $token);
        $modelDao = $query->first();

        return $modelDao?->toDomainEntity();
    }

    /**
     * @param string $email
     * @return Builder|Model
     */
    public function updateOrCreateTokenByEmail(string $email): Model|Builder
    {
        return $this->createQuery()->updateOrCreate([
                                                        'email' => $email,
                                                    ], [
                                                        'token' => Str::random(60),
                                                    ]);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function delete(string $email): mixed
    {
        return $this->createQuery()->where('email', $email)->delete();
    }
}
