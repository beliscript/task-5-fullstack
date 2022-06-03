<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_parameter_gagal() {
        $this->json('POST', 'api/v1/login', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
            ]);
    }
    public function test_login_username_password_salah() {
        $this->json('POST', 'api/v1/login', [
            'email'=> 'rendi@gmail.com',
            'password' => 'passwordsalah',
        ], ['Accept' => 'application/json'])
        ->assertStatus(401)
            ->assertJson([
                "error" => "Unauthorised",
            ]);
    }
    public function test_login_username_password_benar() {
        $this->json('POST', 'api/v1/login', [
            'email'=> 'rendi@gmail.com',
            'password' => 'rendi123',
        ], ['Accept' => 'application/json'])
        ->assertStatus(200)
            ->assertSeeText('token');
    }
}