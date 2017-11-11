<?php

namespace Tests\Feature\Panel\Books;

use App\User;
use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteBooksTest extends TestCase
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
     * Test the ability to delete a book
     */
    public function testCanDeleteABook()
    {
    	// Given I have an admin and a book
    	$book = factory(Book::class)->create();

    	// When the admin delete the book
    	$response = $this->actingAs($this->admin)
    					->call('DELETE', '/admin/books/'.$book->id);

    	// Then it should be trashed
    	$response->assertSuccessful();
    	$this->assertDatabaseMissing('books', [
    		'id' => $book->id,
    		'deleted_at' => null,
    	]);
    }

    /**
     * Test that an admin cannot delete a book that doesn't exist
     */
    public function testCannotDeleteABookThatDoesntExist()
    {
    	// Given I have an admin but a book that no longer exists
    	$book = factory(Book::class)->create();
    	Book::destroy($book->id);

    	// When the admin delete the book
    	$response = $this->actingAs($this->admin)
    					->call('DELETE', '/admin/books/'.$book->id);

    	// Then it should be fail
    	$response->assertStatus(404);
    }
}
