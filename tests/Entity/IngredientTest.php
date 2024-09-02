<?php
declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Ingredient;

/**
 * Class IngredientTest.
 */
class IngredientTest extends BasedEntityTestCase
{
    /**
     * @return Ingredient
     */
    public function getEntity(): Ingredient
    {
        return (new Ingredient())
            ->setWeight(500)
            ->setFoodId(1);
    }

    /**
     * @return void
     */
    public function testValidEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    /**
     * @return void
     */
    public function testInvalidWeigh()
    {
        $this->assertHasErrors($this->getEntity()->setWeight(-1000), 1);
        $this->assertHasErrors($this->getEntity()->setWeight(0), 1);
    }

    /**
     * @return void
     */
    public function testInvalidFoodId()
    {
        $this->assertHasErrors($this->getEntity()->setFoodId(-1), 1);
        $this->assertHasErrors($this->getEntity()->setFoodId(3187), 1);
    }
}
