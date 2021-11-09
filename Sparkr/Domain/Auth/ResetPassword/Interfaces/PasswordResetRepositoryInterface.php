<?php

namespace Sparkr\Domain\Auth\ResetPassword\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Sparkr\Domain\Auth\ResetPassword\Models\PasswordReset;

interface PasswordResetRepositoryInterface
{


    /**
     * @param string $email
     * @return Builder|Model
     */
    public function updateOrCreateTokenByEmail(string $email): Builder|Model;


    /**
     * @param string $token
     * @return Collection|null
     */
    public function getByToken(string $token): ?PasswordReset;

    /**
     * @param string $email
     * @return mixed
     */
    public function delete(string $email): mixed;
}
