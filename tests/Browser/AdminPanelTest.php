<?php

namespace Tests\Browser;

use App\User;
use App\Book;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminPanelTest extends DuskTestCase
{
    use DatabaseTransactions;
    
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
            'rank' => 2,
        ]);

        $book = factory(Book::class)->make();

        // When a desired book is added
        $this->browse(function($browser) use ($user, $book) {
            $browser->loginAs($user)
                    ->visit('/admin/books/add')
                    ->type('isbn', $book->isbn)
                    ->type('price', $book->price)
                    ->press('ADD THE NEW BOOK')
                    ->waitFor('[data-notify="message"]')
                    ->assertSee('successfully created');
        });

        // Then it should be created and exist in the database
        $this->assertDatabaseHas('books', [
            'isbn' => $book->isbn,
        ]);
    }
}
