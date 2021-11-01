<?php

namespace Sparkr\Domain\MasterDataManagement\JobType\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class JobType extends BaseDomainModel
{
    private string $name;

    /**
     * JobType constructor.
     * @param  string  $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
