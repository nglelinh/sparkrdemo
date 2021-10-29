<?php

namespace Sparkr\Domain\UserManagement\UserSocialLink\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class UserSocialLink extends BaseDomainModel
{
    private int $userId;

    private int $socialNetworkId;

    private string $url;

    /**
     * UserSocialLink constructor.
     * @param  int  $userId
     * @param  int  $socialNetworkId
     * @param  string  $url
     */
    public function __construct(int $userId, int $socialNetworkId, string $url)
    {
        $this->userId = $userId;
        $this->socialNetworkId = $socialNetworkId;
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param  int  $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getSocialNetworkId(): int
    {
        return $this->socialNetworkId;
    }

    /**
     * @param  int  $socialNetworkId
     */
    public function setSocialNetworkId(int $socialNetworkId): void
    {
        $this->socialNetworkId = $socialNetworkId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param  string  $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }


}
