<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;

use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
//    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->artisan('migrate:rollback');
//        $this->artisan('migrate --seed');
    }

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
    public function testCreateCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->type('title', 'Культура')
                ->click("button[type='submit']")
                ->visitRoute('admin.category.index');
        });
    }

    /**
     * @throws \Throwable
     */
    public function testCreateCategoryWithFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->type('title', 'К')
                ->click("button[type='submit']")
                ->assertSee('Количество символов в поле Название категории должно быть не менее 3.');
        });
    }
}
