<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class AuthTest extends TestCase
{
    public function testRegister()
    {
        $faker = Faker::create();
        $response = $this->call('POST', '/api/v1/register', [
            "username" => $faker->username,
            "name" => $faker->name,
            "email" => $faker->unique()->safeEmail,
            "password" => Hash::make($faker->password),
        ]);
        $response->assertStatus(200);
    }

    public function testLogin()
    {
        $faker = Faker::create();
        $pass = $faker->password;
        $user = User::factory(\App\Models\User::class)->create(['password'=>Hash::make($pass)]);

        $response = $this->call('POST', '/v1/oauth/token', [
            "grant_type" => "password",
            "client_id" => $_SERVER['CLIENT_ID'],
            "client_secret" => $_SERVER['CLIENT_SECRET'],
            "username" => $user->username,
            "password" => $pass
        ]);

        $response->assertStatus(200);
    }

    public function testProfile()
    {
        $user = User::factory(\App\Models\User::class)->create();
        $this->actingAs($user);

        $response = $this->call('GET', '/api/v1/me');
        $response->assertStatus(200);
    }
}
