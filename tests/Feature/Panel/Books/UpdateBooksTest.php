<?php

namespace Tests\Feature\Panel\Books;

use App\User;
use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateBooksTest extends TestCase
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
     * Test that a book can be updated
     */
    public function testCanUpdateABook()
    {
    	// Given I have an admin, an old book and a new one
    	$old = factory(Book::class)->create();
    	$newBook = factory(Book::class)->create();

    	// When the admin update the book
    	$response = $this->actingAs($this->admin)
    					->post('/admin/books/update', [
    						'id' => $old->id,
    						'price' => $newBook->price,
    					]);

    	// Then it should be updated
    	$response->assertSuccessful();
    	$this->assertDatabaseHas('books', [
    		'id' => $old->id,
    		'isbn' => $old->isbn,
    		'price' => $newBook->price,
    	]);
    }

     /**
     * Test that a book cannot be updated without a new price
     */
    public function testCannotUpdateABookWithoutPrice()
    {
    	// Given I have an admin, an old book and a new one
    	$old = factory(Book::class)->create();
    	$newBook = factory(Book::class)->create();

    	// When the admin update the book without a new price
    	$response = $this->actingAs($this->admin)
    					->post('/admin/books/update', [
    						'id' => $old->id,
    					]);

    	// Then it should fail validation and stay unchanged
    	$response->assertStatus(302);
    	$this->assertDatabaseHas('books', [
    		'id' => $old->id,
    		'isbn' => $old->isbn,
    		'price' => $old->price,
    	]);
    }

     /**
     * Test that a book that doesn't exist cannot be updated
     */
    public function testCannotUpdateABookThatDoesntExist()
    {
    	// Given I have an admin, a book that no longer exists and a new one
    	$old = factory(Book::class)->create();
    	$newBook = factory(Book::class)->create();
    	$old->delete();

    	// When the admin update the book
    	$response = $this->actingAs($this->admin)
    					->post('/admin/books/update', [
    						'id' => $old->id,
    						'price' => $newBook->price,
    					]);

    	// Then it should fail validation and stay unchanged
    	$response->assertStatus(302);
    	$this->assertDatabaseHas('books', [
    		'id' => $old->id,
    		'isbn' => $old->isbn,
    		'price' => $old->price,
    	]);
    }
}
