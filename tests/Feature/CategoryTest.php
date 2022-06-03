<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_category_store_tidak_pakai_headers() {
        $this->json('POST', 'api/v1/categories', ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "message" => "Unauthenticated.",
            ]);
    }
    public function test_category_store_parameter_salah() {
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('POST', 'api/v1/categories', [
            'name' => '1'
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_list_benar() {
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/categories', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "status" => true,
                "message" => "Daftar Kategori",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_store_parameter_benar() {
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('POST', 'api/v1/categories', [
            'name' => random_int(1,1000).'Tester'
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "status" => true,
                "message" => "Berhasil menambahkan data kategori baru",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_update_parameter_salah() {
        $category = Category::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('PUT', 'api/v1/categories/'.$category->id.'', [
            'name' => '',
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_update_parameter_benar() {
        $category = Category::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('PUT', 'api/v1/categories/'.$category->id.'', [
            'name' => random_int(1,1000).'Tester'
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Berhasil memperbaharui data kategori",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_show_benar() {
        $category = Category::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/categories/'.$category->id.'', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Berhasil ditemukan!",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_category_delete_benar() {
        $category = Category::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/categories/'.$category->id.'', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "status" => true,
            ]);
        auth()->user()->token()->revoke();
    }
}