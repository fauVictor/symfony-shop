<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testIsValid(): void
    {
        $category = new Category();

        $category->setName('name');
        $category->addArticle(new Article());

        $this->assertEquals('name', $category->getName());
        $this->assertEquals(new Article(), $category->getArticles()[0]);

    }

    public function testIsInvalid(): void
    {
        $category = new Category();

        $category->setName('name');

        $this->assertNotEquals('false', $category->getName());
        $this->assertNotEquals(new Article(), $category->getArticles()[0]);

    }
}
