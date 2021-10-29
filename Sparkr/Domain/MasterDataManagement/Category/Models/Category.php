<?php

namespace Sparkr\Domain\MasterDataManagement\Category\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class Category extends BaseDomainModel
{
    private string $name;

    /**
     * Category constructor.
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
