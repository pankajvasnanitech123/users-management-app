<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserInformation;

class UserTest extends TestCase
{
    /**
     * Function to test create new user
     */
    public function test_can_create_user() {
        $user = User::factory()->make();

        $arrStatus = ["active", "inactive"];
        $randIndex = array_rand($arrStatus);

        $response = $this->json('POST', route('users.create'),[
            'user_id' => $user->id,
            'status' => $arrStatus[$randIndex],
            'position' => 'Senior Developer'
        ]);

        $response->assertStatus(201)
                    ->assertJson([
                        'success' => true,
                        'message' => ''
                    ]);
    }

    /**
     * Function to test user cannot enter empty status
     */
    public function test_cannot_enter_empty_status() {
        $user = User::factory()->make();

        $response = $this->json('POST', route('users.create'),[
            'user_id' => $user->id,
            'status' => '',
            'position' => 'Senior Developer'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Function to test user cannot enter empty position
     */
    public function test_cannot_enter_empty_position() {
        $user = User::factory()->make();

        $arrStatus = ["active", "inactive"];
        $randIndex = array_rand($arrStatus);

        $response = $this->json('POST', route('users.create'),[
            'user_id' => $user->id,
            'status' => $arrStatus[$randIndex],
            'position' => ''
        ]);

        $response->assertStatus(422);
    }

    /**
     * Function to test show user details
     */
    public function test_show_user_details() {
        $user = User::factory()->create();

        $userInformation = UserInformation::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->json('GET', route('users.show', [$user->id]));

        $response->assertStatus(200);
    }

    /**
     * Function to test update user details
     */
    public function test_can_update_user() {
        $user = User::factory()->create();

        $userInformation = UserInformation::factory()->create([
            'user_id' => $user->id
        ]);
        
        $arrStatus = ["active", "inactive"];
        $randIndex = array_rand($arrStatus);

        $response = $this->json('PUT', route('users.update', [$userInformation->id]),[
            'status' => $arrStatus[$randIndex],
            'position' => 'Senior Developer'
        ]);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'message' => ''
                    ]);
    }

    /**
     * Function to test delete user details
     */
    public function test_can_delete_user() {
        $user = User::factory()->create();

        $userInformation = UserInformation::factory()->create([
            'user_id' => $user->id
        ]);
        
        $arrStatus = ["active", "inactive"];
        $randIndex = array_rand($arrStatus);

        $response = $this->json('POST', route('users.delete', [$userInformation->id]));

        $response->assertStatus(204);
    }
}
