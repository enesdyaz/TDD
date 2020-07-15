<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'awesome book',
            'author' => 'Victor'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());



    }
    /** @test */
    public function a_title_is_required(){

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'victor'
        ]);

        $response->assertSessionHasErrors('title');
    }

        /** @test */
        public function a_author_is_required(){

            $response = $this->post('/books', [
                'title' => 'awesome book',
                'author' => ''
            ]);
    
            $response->assertSessionHasErrors('author');
        }


        /** @test */
        public function a_book_can_be_updated(){

        $this->withoutExceptionHandling();

            $this->post('/books', [
                'title' => 'awesome book',
                'author' => 'victor'
            ]);

            $book = Book::first();  // test의 db는 1개만 존재하기 함

            $response = $this->patch('/books/'.$book->id , [
                'title' => 'new title',
                'author' => 'new author'
            ]);

            $this->assertEquals('new title', Book::first()->title);
            $this->assertEquals('new author', Book::first()->author);




        }
}
