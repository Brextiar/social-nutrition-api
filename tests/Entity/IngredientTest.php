<?php
declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class IngredientTest.
 */
class IngredientTest extends KernelTestCase
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
     * @param Ingredient $ingredient
     * @param int        $number
     *
     * @return void
     */
    public function assertHasErrors(Ingredient $ingredient, int $number = 0): void
    {
        self::bootKernel();
        $container = self::getContainer();
        /** @var ValidatorInterface $validator */
        $validator = $container->get('validator');
        $errors = $validator->validate($ingredient);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        self::assertCount($number, $errors, implode(', ', $messages));
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
    }

    /**
     * @return void
     */
    public function testInvalidFoodId()
    {
        $this->assertHasErrors($this->getEntity()->setFoodId(-1), 1);
        $this->assertHasErrors($this->getEntity()->setFoodId(3187), 1);
        $this->assertHasErrors($this->getEntity()->setFoodId(500), 0);
    }
}
