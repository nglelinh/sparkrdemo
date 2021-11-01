<?php

namespace Sparkr\Domain\MasterDataManagement\Trait\Interfaces;


use Sparkr\Domain\MasterDataManagement\Trait\Models\TraitModel;

interface TraitRepositoryInterface
{
    /**
     */
    public function getAllTrait();

    /**
     */
    public function getById(int $id): TraitModel;

    /**
     */
    public function save(TraitModel $traitModel);

    /**
     */
    public function delete(int $id);


}
