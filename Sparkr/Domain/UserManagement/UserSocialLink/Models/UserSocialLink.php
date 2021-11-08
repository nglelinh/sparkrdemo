<?php

namespace Sparkr\Domain\UserManagement\UserSocialLink\Models;

use Sparkr\Domain\Base\BaseDomainModel;
use Sparkr\Domain\UserManagement\User\Models\User;

/**
 *
 */
class UserSocialLink extends BaseDomainModel
{
    private int $userId;

    private int $socialNetwork;

    private string $url;

    /**
     * UserSocialLink constructor.
     * @param  int  $userId
     * @param  int  $socialNetwork
     * @param  string  $url
     */
    public function __construct(int $userId, int $socialNetwork, string $url)
    {
        $this->userId = $userId;
        $this->socialNetwork = $socialNetwork;
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
    public function getSocialNetwork(): int
    {
        return $this->socialNetwork;
    }

    /**
     * @param  int  $socialNetwork
     */
    public function setSocialNetwork(int $socialNetwork): void
    {
        $this->socialNetwork = $socialNetwork;
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
