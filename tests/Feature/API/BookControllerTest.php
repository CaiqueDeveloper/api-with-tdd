<?php

namespace Tests\Feature\API;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_books_endpoint(): void
    {
        $books = Book::factory(1)->create();

        $response = $this->get('/api/books');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        
        $response->assertJson(function(AssertableJson $json){
            $json->whereAllType([
                '0.id' => 'integer',
                '0.title' => 'string',
                '0.isbn' => 'string',
            ]);
        });
        
    }

    public function test_get_single_book_endpoint(): void
    {

        $book = Book::factory(1)->createOne();
        
        $response = $this->get('/api/books/'.$book->id);
        $response->assertStatus(200);

        $response->assertJson(function(AssertableJson $json) use ($book){

            $json->hasAll(['id','title','isbn','created_at', 'updated_at']);
            
            $json->whereAll([
                'id' => $book->id,
                'title' => $book->title,
                'isbn' => $book->isbn,
            ]);
        });
    }

    public function test_post_books_endpoint(): void
    {

        $book = Book::factory()->makeOne()->toArray();

        $response = $this->postJson('/api/books', $book);
        $response->assertStatus(201);
        $response->assertJson(function(AssertableJson $json) use ($book){

            $json->hasAll(['id', 'title', 'isbn'])->etc();
            $json->whereAll([
                'title' => $book['title'],
                'isbn' => $book['isbn'],
            ])->etc();
        });
    }
    
    public function test_put_books_endpoint(): void
    {
        Book::factory(1)->createOne();
        $book = [
            'title' => 'Updated Book',
            'isbn' => '23154645'
        ];
        $response = $this->putJson('/api/books/1', $book);
        $response->assertStatus(200);
        
        $response->assertJson(function(AssertableJson $json) use ($book){

            $json->hasAll(['id', 'title','isbn'])->etc();
            $json->whereAll([
                'title' => $book['title'],
                'isbn' => $book['isbn'],
            ])->etc();
        });
    }
    
    public function test_patch_books_endpoint(): void
    {
        Book::factory(1)->createOne();
        $book = [
            'title' => 'Updated Book New',
        ];
        $response = $this->patchJson('/api/books/1', $book);
        $response->assertStatus(200);
        
        $response->assertJson(function(AssertableJson $json) use ($book){

            $json->hasAll(['id', 'title','isbn'])->etc();
            $json->whereAll([
                'title' => $book['title'],
            ])->etc();
        });
    }
    
    public function test_delete_books_endpoint(): void
    {
        Book::factory(1)->createOne();
        
        $response = $this->deleteJson('/api/books/1');
        $response->assertStatus(204);
    
    }
}
