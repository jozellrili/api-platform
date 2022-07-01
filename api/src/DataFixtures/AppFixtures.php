<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @var \Faker\Factory
     */
    private $faker;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
        $this->loadBlogPost($manager);
    }

    public function loadBlogPost(ObjectManager $manager)
    {
        $user = $this->getReference('admin_user');

        for ($i = 0; $i < 100; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitle($this->faker->realText(30));
            $blogPost->setAuthor($user);
            $blogPost->setContent($this->faker->realText());
            $blogPost->setPublished($this->faker->dateTimeThisYear);
            $blogPost->setSlug($this->faker->slug);

            $manager->persist($blogPost);
        }

        $manager->flush();
    }

    public function loadUser(ObjectManager $manager)
    {
        $user = new User();

        $user->setName('J Rili');
        $user->setEmail('jozell.rili@flexisourceit.com.au');
        $user->setUsername('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

        $this->addReference('admin_user', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
