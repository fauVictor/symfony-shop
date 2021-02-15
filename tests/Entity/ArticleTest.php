<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testIsValid(): void
    {
        $article = new Article();

        $category = (new Category())->setName('name');

        $article->setName('name');
        $article->setDescription('description');
        $article->setPrice(10.00);
        $article->addCategory($category);

        $this->assertEquals('name', $article->getName());
        $this->assertEquals('description', $article->getDescription());
        $this->assertEquals(10.00, $article->getPrice());
        $this->assertEquals($category, $article->getCategories()[0]);
    }

    public function testIsInvalid()
    {
        $article = new Article();

        $article->setName('name');
        $article->setDescription('description');
        $article->setPrice(10.00);

        $this->assertNotEquals('false', $article->getName());
        $this->assertNotEquals('false', $article->getDescription());
        $this->assertNotEquals(0.00, $article->getPrice());
        $this->assertNotEquals(new Category(), $article->getCategories()[0]);
    }
}
