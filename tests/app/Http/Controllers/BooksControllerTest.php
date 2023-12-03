<?php

namespace Tests\app\Http\Controlers;

use App\Http\Controllers\BooksController;
use App\Models\Books;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register_book(): void
    {
        $user = User::factory()->create();

        //array que será passado como corpo na requisição
        $book = [
            'id' => 1,
            'title' => 'Orgulho e Preconceito',
            'author' => 'Jane Austen',
            'category' => 'romance',
            'format' => 'físico',
        ];
        //garante que não há registro com esses dados no banco
        $this->assertDatabaseMissing('books', [
            'author' => $book['author'],
            'title' => $book['title']
        ]);

        //chama o endpoint passando as informações do livro que será cadastrado
        $response = $this->actingAs($user)->post('/api/books', $book);

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
            'title' => $book['title']
        ]);

        //confirm status code e se os dados do livro cadastrados está sendo devolvido
        $response->assertStatus(201)
            ->assertJsonFragment(['data' => $book]);
    }
    public function test_get_books()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/books');
        $response->assertStatus(200);
    }
    public function test_show_book()
    {
        $user = User::factory()->create();

        //cria o livro
        $book = Books::factory()->create();

        //padronização do corpo da resposta
        $bookResponse = [
            'author' => $book->author,
            'category' => $book->category,
            'format' => $book->format,
            'id' => $book->id,
            'title' => $book->title
        ];

        //chama o endpoint identificando o id do usuário
        $response = $this->actingAs($user)->get('/api/books/1');
        $response->assertStatus(200)->assertJsonFragment(['data' => $bookResponse]);
    }
    public function test_update_book()
    {
        $user = User::factory()->create();

        //cria o livro
        $book = Books::factory()->create();

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
            'title' => $book['title']
        ]);

        $newBook = [
            'id' => 1,
            'title' => 'Sangue Real',
            'author' => 'Jas Silva',
            'category' => 'dark romance',
            'format' => 'ebook',
        ];

        //chama o endpoint passando as informações do livro que serão cadastrados
        $response = $this->actingAs($user)->put('/api/books/1', $newBook);

        //garante que foi feito a alteração com os dados informados
        $this->assertDatabaseHas('books', [
            'author' => $newBook['author'],
            'title' => $newBook['title']
        ]);

        $response->assertStatus(200);
    }
    public function test_delete_book()
    {
        $user = User::factory()->create();

        //cria o livro
        $book = Books::factory()->create();

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
            'title' => $book['title']
        ]);

        //chama o endpoint passando as informações do livro que será apagado
        $response = $this->actingAs($user)->delete('/api/books/1');

        //garante que o cadastro desse livro foi apagado
        $this->assertDatabaseMissing('books', [
            'author' => $book['author'],
            'title' => $book['title']
        ]);

        $response->assertStatus(204);
    }
}
