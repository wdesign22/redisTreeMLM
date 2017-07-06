<?php
namespace AppBundle\DataFixtures\ORM;


use DoctBundle\Entity\Article;
use DoctBundle\Entity\Category;
use DoctBundle\Entity\News;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article=new Article();
        $article->setTitle("My first article");

        $article2=new Article();
        $article2->setTitle("My second article");

        $news = new News();
        $news->setTitle("My first news");

        $category = new Category();
        $category->setName("Category");

        $category2 = new Category();
        $category2->setName("Category 1");

        $article->setCategory($category);
        $article2->setCategory($category2);

        $manager->persist($article);
        $manager->persist($article2);
        $manager->persist($news);

        $manager->persist($category);
        $manager->persist($category2 );

        $manager->flush();



    }
}