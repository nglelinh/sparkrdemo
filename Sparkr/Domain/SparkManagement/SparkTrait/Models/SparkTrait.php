<?php

namespace Sparkr\Domain\SparkManagement\SparkTrait\Models;

use Sparkr\Domain\Base\BaseDomainModel;

/**
 *
 */
class SparkTrait extends BaseDomainModel
{
    private int $companyProfileId;

    private int $traitId;

    private int $sparkTraitCount;

    /**
     * SparkTrait constructor.
     * @param  int  $companyProfileId
     * @param  int  $traitId
     * @param  int  $sparkTraitCount
     */
    public function __construct(int $companyProfileId, int $traitId, int $sparkTraitCount = 0)
    {
        $this->companyProfileId = $companyProfileId;
        $this->traitId = $traitId;
        $this->sparkTraitCount = $sparkTraitCount;
    }

    /**
     * @return int
     */
    public function getCompanyProfileId(): int
    {
        return $this->companyProfileId;
    }

    /**
     * @param  int  $companyProfileId
     */
    public function setCompanyProfileId(int $companyProfileId): void
    {
        $this->companyProfileId = $companyProfileId;
    }

    /**
     * @return int
     */
    public function getTraitId(): int
    {
        return $this->traitId;
    }

    /**
     * @param  int  $traitId
     */
    public function setTraitId(int $traitId): void
    {
        $this->traitId = $traitId;
    }

    /**
     * @return int
     */
    public function getSparkTraitCount(): int
    {
        return $this->sparkTraitCount;
    }

    /**
     * @param  int  $sparkTraitCount
     */
    public function setSparkTraitCount(int $sparkTraitCount): void
    {
        $this->sparkTraitCount = $sparkTraitCount;
    }


}
