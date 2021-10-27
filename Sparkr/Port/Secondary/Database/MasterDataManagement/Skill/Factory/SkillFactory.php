<?php


namespace Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\Factory;



use Sparkr\Port\Secondary\Database\MasterDataManagement\Skill\ModelDao\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}
