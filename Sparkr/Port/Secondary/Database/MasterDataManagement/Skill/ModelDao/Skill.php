<?php

namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao;

use Sparkr\Domain\MasterDataManagement\Skill\Models\Skill as SkillDomainModel;
use Sparkr\Port\Secondary\Database\Base\BaseModel;
//use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits\SkillRelationshipTrait;
//use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Traits\HasFactory;

class Skill extends BaseModel
{
//    use SkillRelationshipTrait, HasFactory;

    /**
     * @var string[]
     */
    protected  $hidden = [
        'created_at' ,
        'updated_at' ,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skills';

    /**
     * @return SkillDomainModel
     */
    public function toDomainEntity(): SkillDomainModel
    {
        $skill = new SkillDomainModel(
            $this->skill_name,
            (bool)$this->is_selectable,
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
        $this->id = $skill->getId();
        $this->skill_name = $skill->getSkillName();
        $this->is_selectable = $skill->isSelectable();

        return $this;
    }
}
