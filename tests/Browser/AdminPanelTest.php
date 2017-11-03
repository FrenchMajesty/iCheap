<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPanelTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * Test the ability to add a desired book.
     *
     * @return void
     */
    public function testCanAddABook()
    {
        // Given I have an admin authenticated and a book to add
        $user = factory(User::class)->create([
            'account' => 'admin',
            'rank' => 1,
        ]);

        $isbn = '0486134768';

        // When a desired book is added
        $this->browse(function($browser) use ($user, $isbn) {
            $browser->loginAs($user)
                    ->visit('/admin/books/add')
                    ->type('isbn', $isbn)
                    ->type('price', '50.48')
                    ->press('ADD THE NEW BOOK')
                    ->assertSee('Book was successfully created');
        });

        // Then it should be created and exist in the database
        $this->assertDatabaseHas('books', [
            'isbn' => $isbn,
        ]);
    }
}
