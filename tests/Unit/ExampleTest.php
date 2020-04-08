<?php

namespace Tests\Unit;

use App\News;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testNewsAll()
    {
        $news = News::all();

        $this->assertIsArray($news);
    }
}
