<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Tests\TestCase;
use App\Models\User;
use App\Models\Community;
use Dflydev\DotAccessData\Data;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * 
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_fech_all_communities()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Community::factory()->count(3)->create();
        $response = $this->getJson("api/posts");

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }
    
    public function test_can_fetch_single_communities()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $community = Community::factory()->create();
        $response = $this->getJson("api/communities/{$community->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'name' => $community->name,
                'description' => $community->description
            ]
        ]);

        $response = $this->get('/api/communities/1');

        $response->assertStatus(200);
        
    }

    public function text_name_of_communities_is_required()
    {
        Sanctum::actingAs(factory(User::class)->create());
        $response = $this->postJson('/api/communities', [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);


    }

    public function test_can_create_communities()
    {
        Sanctum::actingAs(factory()->create());
        $response = $this->postJson('/api/communities', [
            'name' => 'Test Communities'
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'name' => 'Test Communities'
            ]
        ]);
    }

    public function test_guest_cannot_create_communities()
    {
        $response = $this->postJson('/api/communities', [
            'name' => 'Test Communities'
        ]);

        $response->assertStatus(401);
    }

    public function test_can_update_communities()
    {
        Sanctum::actingAs(factory()->create());
        $response = $this->putJson('/api/communities/1', [
            'name' => 'Test Communities'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'name' => 'Test Communities'
            ]
        ]);
    }

    public function test_can_delete_communities()
    {
        Sanctum::actingAs(factory()->create());
        $response = $this->deleteJson('/api/communities/1');

        $response->assertStatus(204);
    }

    public function test_can_returns_a_json_api_error_object_when_a_community_is_not_found()
    {
        $user = factory()->create();

        $response = $this 
            ->actingAs($user)
            ->from('/api/communities/1')
            ->deleteJson('/api/communities/1', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertStatus(404)
            ->assertRedirect('/api/communities/1');


        $this->assertNotNull($user->fresh());

    }
}
