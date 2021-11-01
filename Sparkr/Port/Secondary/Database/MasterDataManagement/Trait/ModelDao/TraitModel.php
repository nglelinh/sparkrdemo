<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Trait\ModelDao;

use Sparkr\Domain\MasterDataManagement\Trait\Models\TraitModel as TraitDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;

class TraitModel extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'traits';

    public function toDomainEntity(): TraitDomainModel
    {
        $traitModel = new TraitDomainModel(
            $this->name,
        );
        $traitModel->setId($this->getKey());

        return $traitModel;
    }

    /**
     * @param TraitDomainModel $traitModel
     * @return TraitModel
     */
    protected function fromDomainEntity($traitModel)
    {
        $this->name = $traitModel->getName();

        return $this;
    }

}
