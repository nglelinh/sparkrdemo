<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao;

use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill as SkillDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits\SkillRelationshipTrait;

class Skill extends BaseModel
{
    use SkillRelationshipTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skills';

    public function toDomainEntity(): SkillDomainModel
    {
        $skill = new SkillDomainModel(
            $this->name,
        );
        $skill->setId($this->getKey());

        return $skill;
    }

    /**
     * @param SkillDomainModel $skill
     * @return Skill
     */
    protected function fromDomainEntity($skill)
    {
        $this->name = $skill->getName();

        return $this;
    }

}
