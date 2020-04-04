<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Привет, исследователь!');
    }

    public function testCategories()
    {
        $response = $this->get('/news/categories');

        $response->assertViewIs('news.category.index');
    }

    public function testAboutPage()
    {
        $response = $this->get('/about');

        $response->assertSeeText('GeekUniversity');
    }
}
