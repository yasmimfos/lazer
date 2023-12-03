<?php

namespace Tests\app\Http\Controlers;

use App\Models\Movies;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_register_movie(): void
    {
        $user = User::factory()->create();

        //array que será passado como corpo na requisição
        $movie = [
            'id' => 1,
            'title' => 'Garota Exemplar',
            'watch_on' => 'netflix',
            'category' => 'suspense',
        ];
        //garante que não há registro com esses dados no banco
        $this->assertDatabaseMissing('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        //chama o endpoint passando as informações do filme que será cadastrado
        $response = $this->actingAs($user)->post('/api/movies', $movie);

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        //confirm status code e se os dados do filme cadastrados está sendo devolvido
        $response->assertStatus(201)
            ->assertJsonFragment(['data' => $movie]);
        ;
    }
    public function test_get_movies()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/movies');
        $response->assertStatus(200);
    }
    public function test_show_movie()
    {
        $user = User::factory()->create();

        //cria o filme
        $movie = Movies::factory()->create();

        //padronização do corpo da resposta
        $movieResponse = [
            'watch_on' => $movie->watch_on,
            'category' => $movie->category,
            'id' => $movie->id,
            'title' => $movie->title
        ];

        //chama o endpoint identificando o id do usuário
        $response = $this->actingAs($user)->get('/api/movies/1');

        //confere status code e corpo da requisição
        $response->assertStatus(200)
            ->assertJsonFragment(['data' => $movieResponse]);
    }

    public function test_update_movies()
    {
        $user = User::factory()->create();

        //cria o filme
        $movie = Movies::factory()->create();

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        //simulação de corpo da requisição
        $movie = [
            'id' => 1,
            'title' => 'Lisbela e o Prosioneiro',
            'watch_on' => 'globoplay',
            'category' => 'comédia romântica',
        ];

        //chama o endpoint identificando o id do usuário
        $response = $this->actingAs($user)->put('/api/movies/1', $movie);

        //confere os dados alterados no banco de dados
        $this->assertDatabaseHas('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        //confere status code e corpo da requisição
        $response->assertStatus(200)
            ->assertJsonFragment(['data' => $movie]);

    }

    public function teste_delete_movie()
    {
        $user = User::factory()->create();

        //cria o filme
        $movie = Movies::factory()->create();

        //conferir os dados cadastrados no banco de dados
        $this->assertDatabaseHas('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        //chama o endpoint identificando o id do usuário
        $response = $this->actingAs($user)->delete('/api/movies/1');

        //garantir que os dados não contam mais no banco
        $this->assertDatabaseMissing('movies', [
            'watch_on' => $movie['watch_on'],
            'title' => $movie['title']
        ]);

        $response->assertStatus(204);
    }
}
