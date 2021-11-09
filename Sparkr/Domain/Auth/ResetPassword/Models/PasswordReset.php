<?php

namespace Sparkr\Domain\Auth\ResetPassword\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class PasswordReset extends BaseDomainModel
{
    private string $email;
    private string $token;
    private string $updateAt;

    /**
     * ResetPassword constructor.
     * @param string $email
     * @param string $token
     * @param string $updateAt
     */
    public function __construct(string $email, string $token, string $updateAt)
    {
        $this->email = $email;
        $this->token = $token;
        $this->updateAt = $updateAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     *
     */
    public function getUpdateAt(): string
    {
        return $this->updateAt;
    }

    /**
     * @param string $password
     */
    public function setToken(string $password): void
    {
        $this->token = $password;
    }
}
