<?php

namespace Sparkr\Port\Secondary\Database\Auth\PasswordReset\ModelDao;

use Sparkr\Domain\Auth\ResetPassword\Models\PasswordReset as PasswordResetDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class PasswordReset extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_resets';

    public function toDomainEntity(): PasswordResetDomainModel
    {
        $passwordReset = new PasswordResetDomainModel(
            $this->email, $this->token, $this->updated_at
        );
        $passwordReset->setId($this->getKey());

        return $passwordReset;
    }

    /**
     * @param PasswordResetDomainModel $passwordReset
     * @return PasswordReset
     */
    protected function fromDomainEntity($passwordReset)
    {
        $this->email = $passwordReset->getEmail();
        $this->token = $passwordReset->getToken();
        $this->updateAt = $passwordReset->getUpdateAt();

        return $this;
    }

}
