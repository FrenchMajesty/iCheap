<?php

namespace Tests\Feature\Panel\Books;

use App\User;
use App\Book;
use Tests\TestCase;
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
                        'title' => $book->title,
                        'authors' => $book->authors,
                        'publisher' => $book->publisher,
                        'image' => $book->image,
                    ]);

        // Then it should be created and exist in the database
        $response->assertStatus(200);
        $this->assertDatabaseHas('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created without an ISBN
     */
    public function testCannotAddBookWithoutISBN()
    {
        // Given I have an admin and a book without an ISBN
        $book = factory(Book::class)->make([
            'isbn' => '',
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created without a price
     */
    public function testCannotAddBookWithoutPrice()
    {
        // Given I have an admin and a book without a price
        $book = factory(Book::class)->make([
            'price' => '',
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

     /**
     * Test that a book cannot be created with a duplicate ISBN
     */
    public function testCannotAddBookWhenBookWithISBNThatAlreadyExists()
    {
        // Given I have an admin, an old book, and a new one
        $original = factory(Book::class)->create();
        $book = factory(Book::class)->make();

        // When a desired book is added with the same ISBN as another book
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $original->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation
        $response->assertStatus(302);
    }

    /**
     * Test that a book cannot be created with an ISBN too short
     */
    public function testCannotAddBookWhenISBNTooShort()
    {
        // Given I have an admin and a book without a ISBN less than
        // 8 char long.
        $book = factory(Book::class)->make([
            'isbn' => str_repeat('a', 7),
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created with an ISBN too long
     */
    public function testCannotAddBookWhenISBNTooLong()
    {
        // Given I have an admin and a book with an ISBN more than
        // 15 char long.
        $book = factory(Book::class)->make([
            'isbn' => str_repeat('a', 16),
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created with a price too small
     */
    public function testCannotAddBookWhenPriceTooSmall()
    {
        // Given I have an admin and a book with a price less than
        // 5.
        $book = factory(Book::class)->make([
            'price' => 4.99,
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created with a price too big
     */
    public function testCannotAddBookWhenPriceTooBig()
    {
        // Given I have an admin and a book with a price over 
        // 10,000.
        $book = factory(Book::class)->make([
            'price' => 10001,
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }

    /**
     * Test that a book cannot be created with an non-numerical price
     */
    public function testCannotAddBookWhenPriceNotANumber()
    {
        // Given I have an admin and a book with an invalid price
        $book = factory(Book::class)->make([
            'price' => 'not a number',
        ]);

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
        ]);
    }
}
