<?php

namespace App\Tests\Entity;

use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testIsValid(): void
    {
        $user = new User();

        $user->setEmail('true@true.com');
        $user->setPassword('password');
        $user->setRoles(['ROLE_TEST']);

        $user->setCivility('M.');
        $user->setFirstname('Victor');
        $user->setLastname('FAU');

        $user->setCreatedAt(new DateTime('2021-01-01T00:00:00.000000'));
        $user->setUpdatedAt(new DateTime('2021-01-01T00:00:00.000000'));

        $this->assertEquals($user->getEmail(), 'true@true.com');
        $this->assertEquals($user->getPassword(), 'password');
        $this->assertEquals($user->getRoles(), ['ROLE_TEST', 'ROLE_USER']);

        $this->assertEquals($user->getCivility(), 'M.');
        $this->assertEquals($user->getFirstname(), 'Victor');
        $this->assertEquals($user->getLastname(), 'FAU');
        $this->assertEquals($user->getIdentity(), 'M. Victor FAU');

        $this->assertEquals($user->getCreatedAt(), new DateTime('2021-01-01T00:00:00.000000'));
        $this->assertEquals($user->getUpdatedAt(), new DateTime('2021-01-01T00:00:00.000000'));
    }

    public function testIsInvalid()
    {
        $user = new User();

        $user->setEmail('true@true.com');
        $user->setPassword('password');
        $user->setRoles(['ROLE_TEST']);

        $user->setCivility('M.');
        $user->setFirstname('Victor');
        $user->setLastname('FAU');

        $user->setCreatedAt(new DateTime('2021-01-01T00:00:00.000000'));
        $user->setUpdatedAt(new DateTime('2021-01-01T00:00:00.000000'));

        $this->assertNotEquals($user->getEmail(), 'false@false.com');
        $this->assertNotEquals($user->getPassword(), 'false');
        $this->assertNotEquals($user->getRoles(), ['ROLE_USER']);


        $this->assertNotEquals($user->getCivility(), 'false');
        $this->assertNotEquals($user->getFirstname(), 'false');
        $this->assertNotEquals($user->getLastname(), 'false');
        $this->assertNotEquals($user->getIdentity(), 'false');


        $this->assertNotEquals($user->getCreatedAt(), new DateTime('2020-01-01T00:00:00.000000'));
        $this->assertNotEquals($user->getUpdatedAt(), new DateTime('2020-01-01T00:00:00.000000'));
    }
}
