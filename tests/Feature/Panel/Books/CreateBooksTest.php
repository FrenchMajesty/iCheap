<?php

namespace Tests\Feature\Panel\Books;

use App\User;
use App\Book;
use App\Book\BookDimensions;
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
        // Given I have an admin and a book to add with its dimensions
        $book = factory(Book::class)->make();
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                    ->post('/admin/books/add', [
                        'isbn' => $book->isbn,
                        'price' => $book->price,
                        'title' => $book->title,
                        'authors' => $book->authors,
                        'publisher' => $book->publisher,
                        'image' => $book->image,
                        'description' => $book->description,
                        'height' => $dimensions->height,
                        'width' => $dimensions->width,
                        'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created without an ISBN
     */
    public function testCannotAddBookWithoutISBN()
    {
        // Given I have an admin and a book without an ISBN and the book's dimensions
        $book = factory(Book::class)->make([
            'isbn' => '',
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'price' => $book->price,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created without a price
     */
    public function testCannotAddBookWithoutPrice()
    {
        // Given I have an admin and a book without a price and the book's dimensions
        $book = factory(Book::class)->make([
            'price' => '',
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
                        ]);

        // Then it should fail validation and not be created
        $response->assertStatus(302);
        $this->assertDatabaseMissing('books', [
            'isbn' => $book->isbn,
            'title' => $book->title,
            'authors' => $book->authors,
            'publisher' => $book->publisher,
            'image' => $book->image,
            'description' => $book->description,
        ]);
    }

     /**
     * Test that a book cannot be created with a duplicate ISBN
     */
    public function testCannotAddBookWhenBookWithISBNThatAlreadyExists()
    {
        // Given I have an admin, an old book, and a new book with its dimensions 
        $original = factory(Book::class)->create();
        $book = factory(Book::class)->make();
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added with the same ISBN as another book
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $original->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
                        ]);

        // Then it should fail validation
        $response->assertStatus(302);
    }

    /**
     * Test that a book cannot be created with an ISBN too short
     */
    public function testCannotAddBookWhenISBNTooShort()
    {
        // Given I have an admin, a book with a ISBN less than
        // 8 char long. and the book's dimensions
        $book = factory(Book::class)->make([
            'isbn' => str_repeat('a', 7),
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created with an ISBN too long
     */
    public function testCannotAddBookWhenISBNTooLong()
    {
        // Given I have an admin, a book with an ISBN more than
        // 15 char long. and the book's dimensions
        $book = factory(Book::class)->make([
            'isbn' => str_repeat('a', 16),
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created with a price too small
     */
    public function testCannotAddBookWhenPriceTooSmall()
    {
        // Given I have an admin, a book with a price less than
        // 5. and its dimensions
        $book = factory(Book::class)->make([
            'price' => 4.99,
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created with a price too big
     */
    public function testCannotAddBookWhenPriceTooBig()
    {
        // Given I have an admin, a book with a price over 
        // 10,000 and the book's dimensions
        $book = factory(Book::class)->make([
            'price' => 10001,
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }

    /**
     * Test that a book cannot be created with an non-numerical price
     */
    public function testCannotAddBookWhenPriceNotANumber()
    {
        // Given I have an admin, a book with an invalid price and the book's dimensions
        $book = factory(Book::class)->make([
            'price' => 'not a number',
        ]);
        $dimensions = factory(BookDimensions::class)->make();

        // When a desired book is added
        $response = $this->actingAs($this->admin)
                        ->post('/admin/books/add', [
                            'isbn' => $book->isbn,
                            'price' => $book->price,
                            'title' => $book->title,
                            'authors' => $book->authors,
                            'publisher' => $book->publisher,
                            'image' => $book->image,
                            'description' => $book->description,
                            'height' => $dimensions->height,
                            'width' => $dimensions->width,
                            'thickness' => $dimensions->thickness,
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
            'description' => $book->description,
        ]);
    }
}
