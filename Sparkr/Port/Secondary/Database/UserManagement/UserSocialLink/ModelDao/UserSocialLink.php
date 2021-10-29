<?php

namespace Sparkr\Port\Secondary\Database\UserManagement\UserSocialLink\ModelDao;

use Sparkr\Domain\UserManagement\UserSocialLink\Models\UserSocialLink as UserSocialLinkDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class UserSocialLink extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_social_link';

    public function toDomainEntity(): UserSocialLinkDomainModel
    {
        $userSocialLink = new UserSocialLinkDomainModel(
            $this->user_id,
            $this->social_network_id,
            $this->url,
        );
        $userSocialLink->setId($this->getKey());

        return $userSocialLink;
    }

    /**
     * @param UserSocialLinkDomainModel $userSocialLink
     * @return UserSocialLink
     */
    protected function fromDomainEntity($userSocialLink)
    {
        $this->user_id = $userSocialLink->getUserId();
        $this->social_network_id = $userSocialLink->getSocialNetworkId();
        $this->url = $userSocialLink->getUrl();

        return $this;
    }

}
