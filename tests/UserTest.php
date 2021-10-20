<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\UserProfile;

class UserTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void //sets up doctrine manager for us
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                    ->get('doctrine')
                                    ->getManager();
    }

    //test if our entity adds a user to the db successfully
    public function testUserCreation(): void
    {
        $userProfile = new UserProfile();

        $userProfile->setUsername("test user");
        $userProfile->setEmail("test@test.com");
        $userProfile->setPassword("123456");

        //TODO: Assert to ensure the email doesn't already exist

        //assert that all the values are strings
        $this->assertIsString($userProfile->getUsername());
        $this->assertIsString($userProfile->getEmail());
        $this->assertIsString($userProfile->getPassword());

        //update our db
        $this->entityManager->persist($userProfile);
        $this->entityManager->flush();

    }

    //test if we can find the correct user using the email
    /**
     * @depends testUserCreation
     */
    public function testSearchByEmail(): void
    {
        $userProfile = $this->entityManager
                        ->getRepository(UserProfile::class)
                        ->findOneBy(['email' => "test@test.com"]);

        //assert if the values are correct
        $this->assertEquals("test@test.com", $userProfile->getEmail());
        $this->assertEquals("test user", $userProfile->getUsername());
        $this->assertSame("123456", $userProfile->getPassword());

    }

    protected function tearDown(): void 
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
