<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Ramsey\Uuid\Uuid;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function setBrietgame($manager): void 
    {
        $user = new User();
        $user->setEmail('alexis.briet2003@gmail.com');
        $user->setPseudo('BRIETGAME');
        $user->setUserFirstName('Alexis');
        $user->setUserLastName('BRIET');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'azerty');
        $user->setPassword($password);

        $this->addReference('user_1', $user);

        $manager->persist($user);
    }

    public function setArtaic($manager): void 
    {
        $user = new User();
        $user->setEmail('chajer@live.com');
        $user->setPseudo('Artaïc');
        $user->setUserFirstName('Jérémy');
        $user->setUserLastName('CHAUMET');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'test');
        $user->setPassword($password);

        $this->addReference('user_2', $user);

        $manager->persist($user);
    }

    public function setWeboscket($manager): void 
    {
        $user = new User();
        $user->setEmail('websocket@artaic.fr');
        $user->setPseudo('Webocket');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'test');
        $user->setPassword($password);

        $this->addReference('user_3', $user);

        $manager->persist($user);
    }

    public function load(ObjectManager $manager): void
    {
        $this->setBrietgame($manager);
        $this->setArtaic($manager);
        $this->setWeboscket($manager);
        $manager->flush();
    }
}
