<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * @throws \Throwable
     */
    public function testDontSeeLinkAddNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/news/categories')
                    ->assertDontSeeLink('Добавить новость');
        });
    }

    /**
     * @throws \Throwable
     */
    public function testAuth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/auth')
                ->type('login', 'user')
                ->type('password', '12345')
                ->click("button[type='submit']")
                ->assertSeeLink('Выйти');
        });
    }
}
