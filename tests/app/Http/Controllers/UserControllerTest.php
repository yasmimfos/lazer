<?php

namespace Tests\app\Http\Controlers;

use App\Http\Controllers\UserController;
use App\Models\User;
use Database\Factories\UserFactory;
use FactoryClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_users(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users');
        $response->assertStatus(200);
    }

    public function test_create_user()
    {
        $user = array(
            'name' => 'usuario',
            'email' => 'usuario@mail.com',
            'password' => '124578',
        );

        //garante que não há registro com esses dados no banco
        $this->assertDatabaseMissing('users', [
            'email' => $user['email'],
            'name' => $user['name']
        ]);

        //invoca endpoint e deverá ser inserido os dados no banco
        $response = $this->post('/api/users', $user);

        $response->assertStatus(201);

        //garante que foi feito um registro com os dados informados
        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
            'name' => $user['name']
        ]);

    }

    public function test_show_user_authenticated()
    {
        $user = User::factory()->create();
        $userAuth = [
            'email' => $user->email,
            'id' => $user->id,
            'name' => $user->name,
        ];
        //chama o endpoint com o id
        $response = $this->actingAs($user)->get('/api/users/1');

        //garante que a informação na no corpo da resposta é igual ao usuário criado
        $response->assertStatus(200)
            ->assertJsonFragment(['data' => $userAuth]);
    }
    public function test_update_user()
    {
        $user = User::factory()->create();

        $newUser = array(
            'id' => 1,
            'name' => 'novousuario',
            'email' => 'novousuario@mail.com',
            'password' => '124578',
        );
        //chama o endpoint com o id e passa as informações que devem ser alteradas
        $response = $this->actingAs($user)->put('/api/users/1', $newUser);

        //confirma no banco de dados se as novas informações foram passadas
        $this->assertDatabaseHas('users', [
            'email' => $newUser['email'],
            'id' => $newUser['id']
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();

        //confere no banco de dados se o usuário existe
        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
            'id' => $user['id']
        ]);
        //chama o endpoint com o id do usuário e apaga usuario
        $response = $this->actingAs($user)->delete('/api/users/1');

        //confere se o usuário não consta no banco de dados
        $this->assertDatabaseMissing('users', [
            'email' => $user['email'],
            'id' => $user['id']
        ]);

        $response->assertStatus(204);
    }
}