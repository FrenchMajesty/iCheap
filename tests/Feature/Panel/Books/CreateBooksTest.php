<?php

namespace Tests\Feature\Panel\Books;

use Auth;
use App\User;
use App\Book;
use Tests\TestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateBooksTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;

    /**
     * Set up the test case
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->admin = factory(User::class)->create([
            'account' => 'admin',
            'rank' => 2,
        ]);
    }

    /**
     * Test the ability to add a desired book.
     */
    public function testCanAddABook()
    {
        // Given I have an admin and a book to add
        $book = factory(Book::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                    ->post('/admin/books/add', [
                        'isbn' => $book->isbn,
                        'price' => $book->price,
                    ]);

        // Then it should be created and exist in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
        ]);
    }
}