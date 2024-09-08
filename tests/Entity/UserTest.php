<?php

namespace App\Tests\Entity;

use App\Entity\User;

/**
 * Class UserTest.
 */
class UserTest extends BasedEntityTestCase
{
    /**
     * Get a valid entity.
     *
     * @return User
     */
    public function getEntity(): User
    {
        return (new User())
            ->setEmail('user@test.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword('Gricky%32')
            ->setPseudo('Brextiar65')
            ->setBirthDate(new \DateTime('1989-01-01'))
            ->setProfilPicturePath('profile.jpg')
            ->setDescription('I am a user test')
            ->setSubscriptionDate(new \DateTime('2021-01-01'))
            ->setLastLogin(new \DateTime('2023-01-01'))
            ;
    }

    /**
     * Test a valid entity.
     *
     * @return void
     */
    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    /**
     * Test an invalid email.
     *
     * @return void
     */
    public function testInvalidEmail(): void
    {
        $this->assertHasErrors($this->getEntity()->setEmail('user@test'), 1);
        $this->assertHasErrors($this->getEntity()->setEmail('user@test.'), 1);
        $this->assertHasErrors($this->getEntity()->setEmail('user@test.c'), 1);
    }

    /**
     * Test an invalid password.
     *
     * @return void
     */
    public function testInvalidPassword(): void
    {
        $this->assertHasErrors($this->getEntity()->setPassword('password'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('password123'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('password123!'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('PASSWORD123!'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('PASSWORD123'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('PASSWORD'), 1);
        $this->assertHasErrors($this->getEntity()->setPassword('passwor'), 1);
    }

    /**
     * Test an invalid pseudo.
     *
     * @return void
     */
    public function testInvalidPseudo(): void
    {
        $this->assertHasErrors($this->getEntity()->setPseudo('Pseu@do45'), 0);
        $this->assertHasErrors($this->getEntity()->setPseudo('pse'), 1);
        $this->assertHasErrors($this->getEntity()->setPseudo('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'), 1);
        $this->assertHasErrors($this->getEntity()->setPseudo('Pse udo45'), 1);
    }

    /**
     * Test an invalid birthdate.
     *
     * @return void
     *
     * @throws \DateMalformedStringException
     */
    public function testInvalidBirthDate(): void
    {
        $this->assertHasErrors($this->getEntity()->setBirthDate(new \DateTime()), 1);
        $this->assertHasErrors($this->getEntity()->setBirthDate((new \DateTime())->modify('-13 years +1 day')), 1);
        $this->assertHasErrors($this->getEntity()->setBirthDate((new \DateTime())->modify('-100 years')), 1);
    }

}
