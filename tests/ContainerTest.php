<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Container;
use Faker\Factory as Faker;

class ContainerTest extends TestCase
{
    private function user(){
        return User::factory(\App\Models\User::class)->create();
    }

    public function testContainerGetWithoutAuth()
    {
        // send request to api
        $response = $this->call('GET', '/api/v1/containers');
        $response->assertStatus(401);
    }

    public function testContainerGetWithAuth()
    {
        // user auth
        $user = $this->user();
        $this->actingAs($user);

        // send request to api
        $response = $this->call('GET', '/api/v1/containers');
        $response->assertStatus(200);
    }

    public function testContainerCreate()
    {
        // init faker
        $faker = Faker::create();

        // user auth
        $user = $this->user();
        $this->actingAs($user);

        // send request to api
        $response = $this->call('POST', '/api/v1/containers', [
            "name" => "Container {$faker->buildingNumber}",
            "max_balls" => $faker->numberBetween(3, 10),
        ]);

        // status code must 201 created
        $response->assertStatus(201);
    }

    public function testContainerPutBallFirst()
    {
        // user auth
        $user = $this->user();
        $this->actingAs($user);

        // create many container
        Container::factory(\App\Models\Container::class)->count(10)->create(['user_id'=>$user->id]);

        // send request to api first time
        $responseFirstTime = $this->call('POST', '/api/v1/player/put-ball', []);

        // status code must 200 ok
        $responseFirstTime->assertStatus(200);

        // convert json to array
        $resFTArr = json_decode($responseFirstTime->getContent());
        $this->assertEquals(true, $resFTArr->status);
    }

    public function testContainerPutBallFull()
    {
        // user auth
        $user = User::factory(\App\Models\User::class)->create();
        $this->actingAs($user);

        // create one container
        Container::factory(\App\Models\Container::class)->count(1)->create(['user_id'=>$user->id, 'max_balls'=>3]);

        // Put ball to container success condition
        for($i=1;$i<=3;$i++){
            // send request to api first time
            $responseFirstTime = $this->call('POST', '/api/v1/player/put-ball', []);
            // convert json to array
            $resFTArr = json_decode($responseFirstTime->getContent());
            $this->assertEquals(true, $resFTArr->status);
        }

        // Some container were full of balls. Ready to play :)
        for($i=1;$i<=2;$i++){
            // send request to api first time
            $responseFirstTime = $this->call('POST', '/api/v1/player/put-ball', []);
            // convert json to array
            $resFTArr = json_decode($responseFirstTime->getContent());
            $this->assertEquals(false, $resFTArr->status);
        }
    }
}
