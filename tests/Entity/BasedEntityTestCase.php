<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BasedEntityTestCase extends KernelTestCase
{
    /**
     * @param object $entity
     * @param int    $number
     *
     * @return void
     */
    protected function assertHasErrors(object $entity, int $number = 0): void
    {
        self::bootKernel();
        $container = self::getContainer();

        /** @var ValidatorInterface $validator */
        $validator = $container->get(ValidatorInterface::class);
        $errors = $validator->validate($entity);

        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }

        self::assertCount($number, $errors, implode(', ', $messages));
    }
}