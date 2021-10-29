<?php

namespace Sparkr\Domain\SparkManagement\SparkTrait\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class SparkTraitDetail extends BaseDomainModel
{
    private int $sparkTraitId;

    private int $personalProfileId;

    /**
     * SparkTraitDetail constructor.
     * @param  int  $sparkTraitId
     * @param  int  $personalProfileId
     */
    public function __construct(int $sparkTraitId, int $personalProfileId)
    {
        $this->sparkTraitId = $sparkTraitId;
        $this->personalProfileId = $personalProfileId;
    }

    /**
     * @return int
     */
    public function getSparkTraitId(): int
    {
        return $this->sparkTraitId;
    }

    /**
     * @param  int  $sparkTraitId
     */
    public function setSparkTraitId(int $sparkTraitId): void
    {
        $this->sparkTraitId = $sparkTraitId;
    }

    /**
     * @return int
     */
    public function getPersonalProfileId(): int
    {
        return $this->personalProfileId;
    }

    /**
     * @param  int  $personalProfileId
     */
    public function setPersonalProfileId(int $personalProfileId): void
    {
        $this->personalProfileId = $personalProfileId;
    }



}
