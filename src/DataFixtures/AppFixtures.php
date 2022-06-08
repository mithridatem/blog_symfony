<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = [];
        for($i=0; $i<50; $i++){
            $user = new User();
            $user->setName($faker->lastName());
            $user->setFirstname($faker->firstName());
            $user->setMail($faker->email());
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($user);
            $users[] = $user;
        }
        $cats =[];
        for($i=0; $i<50; $i++){
            $category = new Category();
            $category->setTitle($faker->jobTitle());
            $category->setDescription($faker->text(200));
            $category->setImage($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));
            $category->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($category);
            $cats[]= $category;
        }
        $articles =[];
        for($i=0; $i<50; $i++){
            $art = new Article();
            $art->setTitle($faker->jobTitle());
            $art->setContenu($faker->text(200));
            $art->setImage($faker->imageUrl(360, 360, 'animals', true, 'dogs', true));
            $art->setCreatedAt(new \DateTimeImmutable());
            $art->setUpdatedAt(new \DateTimeImmutable());
            $art->setWriteBy($users[rand(0,49)]);
            $art->addCategory($cats[rand(0,49)]);
            $manager->persist($art);
            $articles[] = $art;
        }
        $manager->flush();
    }
}
