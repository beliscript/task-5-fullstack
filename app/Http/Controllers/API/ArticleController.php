<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category','user')->orderby('id','desc')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Daftar Artikel',
            'data' => $articles
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        try {
            $filename = ArticleService::insertImage($request);
            $article = auth()->user()->articles()->create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $filename,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambahkan data artikel baru',
                'data' => $article
            ],202);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('category','user')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil ditemukan!',
            'data' => $article
        ],200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        try {
            if($request->image) {
                $filename = ArticleService::insertImage($request);

                if(File::exists(public_path('public/Image/'.$article->image.''))  and $article->image  != 'dummy.png') {
                    File::delete(public_path('public/Image/'.$article->image.''));
                }
                $article->update([
                    'image' => $filename
                ]);
            }
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil memperbaharui data artikel',
                'data' => $article
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if(File::exists(public_path('public/Image/'.$article->image.''))  and $article->image  != 'dummy.png') {
            File::delete(public_path('public/Image/'.$article->image.''));
        }
        $temp = $article;
        $article->delete();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus title '.$temp->title.'',
        ],200);
    }
}