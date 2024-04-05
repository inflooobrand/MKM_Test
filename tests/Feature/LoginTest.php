<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginTest extends TestCase
{
    use DatabaseTransactions;

  public function testUserCanLoginWithValidCredentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'estel.halvorson@example.com',
            'password' => 'Test@123',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
        // dump($response->getContent());
    }

}
