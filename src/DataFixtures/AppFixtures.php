<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadMicroPosts($manager);

        $this->loadUsers($manager);
    }

    public function loadMicroPosts(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $microPost = new MicroPost();

            $microPost->setText('Some random text '.rand(0, 100));
            $microPost->setTime(new \DateTime(rand(1999, 2017).'-'.rand(1, 12).'-'.rand(1, 27)));
            $manager->persist($microPost);
        }

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('john_doe');
        $user->setFullName('John Doe');
        $user->setEmail('john_doe@mail.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'john123')
        );

        $manager->persist($user);
        $manager->flush();
    }
}
