<?php

namespace App\DataFixtures;

//Import de Faker PHP
use Faker\Factory;
use Faker;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Créer une instance de faker
        $faker = Faker\Factory::create('fr_FR');

        $users=[];
        $categories=[];

        //Ajouter 20 User
        for($i=0; $i<20; $i++){
            $user = new User();
            $user->setNameUser($faker->lastname())
                ->setFirstnameUser($faker->firstname())
                ->setEmailUser($faker->unique()->email())
                ->setPasswordUser($faker->password())
                ->setCreatedAt(new \DateTimeImmutable());
            array_push($users,$user);
            $manager->persist($user);
        }

        //Ajouter 10 Category
        for($i=0; $i<10; $i++){
            $category = new Category();
            $category->setNameCat($faker->word())
                ->setDescriptionCat($faker->sentence());
            array_push($categories,$category);
            $manager->persist($category);
        }

        //Ajouter 100 Article
        for($i=0; $i<100; $i++){
            $article = new Article();
            $article->setTitleArticle($faker->sentence())
                ->setContentArticle($faker->paragraph())
                ->setImageArticle($faker->image())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setPublishedAt(new \DateTimeImmutable());
            
            $randomUser = $faker->randomElement($users);
            $article->setWriteBy($randomUser);

            $randomCategories = $faker->randomElements($categories, $faker->numberBetween(1, 3));
            foreach ($randomCategories as $cat) {
                $article->addCategory($cat);
            }

            $manager->persist($article);
        }
        $manager->flush();
    }
}
