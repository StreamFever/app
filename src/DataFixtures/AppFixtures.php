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

    public function setOlaf($manager): void
    {
        $user = new User();
        $user->setEmail('steven.derain4@gmail.com');
        $user->setPseudo('Olaf');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'T6DNrXMEfPM4Ha7z');
        $user->setPassword($password);

        $this->addReference('user_3', $user);

        $manager->persist($user);
    }

    public function setJulien($manager): void
    {
        $user = new User();
        $user->setEmail('zuulienn@gmail.com');
        $user->setPseudo('Julien');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, '5KMHA5DzX7kd5isR');
        $user->setPassword($password);

        $this->addReference('user_3', $user);

        $manager->persist($user);
    }

    public function setAcoui($manager): void
    {
        $user = new User();
        $user->setEmail('axeloudart67130@gmail.com');
        $user->setPseudo('Julien');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, '89coDHjdg9FsMEF6');
        $user->setPassword($password);

        $this->addReference('user_3', $user);

        $manager->persist($user);
    }

    public function setExcel($manager): void
    {
        $user = new User();
        $user->setEmail('simon.lecoulant35450@gmail.com');
        $user->setPseudo('Excel');
        $user->setUuid(Uuid::uuid4());
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'aF5RrCdH7rJydHiE');
        $user->setPassword($password);

        $this->addReference('user_3', $user);

        $manager->persist($user);
    }

    public function load(ObjectManager $manager): void
    {
        $this->setBrietgame($manager);
        $this->setArtaic($manager);
        $this->setAcoui($manager);
        $this->setExcel($manager)
        $this->setOlaf($manager);
        $this->setWeboscket($manager);
        $manager->flush();
    }
}
