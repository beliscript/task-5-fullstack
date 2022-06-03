<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_article_store_tidak_pakai_headers() {
        $this->json('POST', 'api/v1/articles', ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "message" => "Unauthenticated.",
            ]);
    }
    public function test_article_store_parameter_salah() {
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('POST', 'api/v1/articles', [
            'name' => '1'
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_article_list_benar() {
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/articles', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "status" => true,
                "message" => "Daftar Artikel",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_article_store_parameter_benar() {
        $category = Category::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        Storage::fake('avatars');
        $this->json('POST', 'api/v1/articles', [
            'title' => 'Tester'.random_int(1,1000),
            'content' => 'lorem aja',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(202)
            ->assertJson([
                "status" => true,
                "message" => "Berhasil menambahkan data artikel baru",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_article_update_parameter_salah() {
        $article = Article::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('PUT', 'api/v1/articles/'.$article->id.'', [
            'name' => '',
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_article_update_parameter_benar() {
        $category = Category::orderby('id','desc')->first();
        $article = Article::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('PUT', 'api/v1/articles/'.$article->id.'', [
            'title' => 'Tester'.random_int(1,1000),
            'content' => 'lorem aja',
            'category_id' => $category->id,
        ],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Berhasil memperbaharui data artikel",
            ]);

        auth()->user()->token()->revoke();
    }
    public function test_article_show_benar() {
        $article = Article::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/articles/'.$article->id.'', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Berhasil ditemukan!",
            ]);
        auth()->user()->token()->revoke();
    }
    public function test_article_delete_benar() {
        $article = Article::orderby('id','desc')->first();
        $data = [
            'email' => 'rendi@gmail.com',
            'password' => 'rendi123'
        ];
        auth()->attempt($data);
        $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
        // dd($token);
        $this->json('GET', 'api/v1/articles/'.$article->id.'', [],['Accept' => 'application/json',
        'Authorization' =>  'Bearer '.$token.' '])
            ->assertStatus(200)
            ->assertJson([
                "status" => true,
            ]);
        auth()->user()->token()->revoke();
    }
}