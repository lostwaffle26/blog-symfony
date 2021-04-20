<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use App\Entity\Users;
use App\Entity\KeyWords;
use App\Entity\Commentary;
use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Articles
        $articles = new Articles();
        $manager->persist($articles);
        $manager->flush();
      
        // Users 
        $users = new Users();
        $users->setEmail('admin@admin.com');
        $users->setRoles(array('ROLE_ADMIN'));

        $password = $this->encoder->encodePassword($users, 'adminadmin');
        $users->setPassword($password);

        $manager->persist($users);
        $manager->flush();

        // Key words
        $keyWords = new KeyWords();
        $manager->persist($keyWords);
        $manager->flush();

        // Commentaires
        $commentary = new Commentary();
        $manager->persist($commentary);
        $manager->flush();

        // Catégories
        $categories = new Categories();
        $manager->persist($categories);
        $manager->flush();

    }
}
