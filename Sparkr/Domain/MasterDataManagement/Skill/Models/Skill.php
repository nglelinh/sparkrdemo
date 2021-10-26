<?php


namespace Sparkr\Domain\MasterDataManagement\Skill\Models;


use Sparkr\Domain\Base\BaseDomainModel;

class Skill extends BaseDomainModel
{
    private string $skillName;
    private bool $isSelectable;

    public function __construct(
        string $skillName,
        bool $isSelectable = true
    ) {
        $this->setSkillName($skillName);
        $this->setIsSelectable($isSelectable);
    }

    /**
     * @param bool $isSelectable
     */
    public function disable(): void
    {
        $this->isSelectable = false;
    }

    /**
     * @return string
     */
    public function getSkillName(): string
    {
        return $this->skillName;
    }

    /**
     * @param string $skillName
     */
    public function setSkillName(string $skillName): void
    {
        $this->skillName = $skillName;
    }

    /**
     * @return bool
     */
    public function isSelectable(): bool
    {
        return $this->isSelectable;
    }

    /**
     * @param bool $isSelectable
     */
    public function setIsSelectable(bool $isSelectable = true): void
    {
        $this->isSelectable = $isSelectable;
    }
}
