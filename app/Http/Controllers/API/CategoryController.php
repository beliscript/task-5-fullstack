<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Exception;
class CategoryController extends Controller
{

   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('user')->orderby('id','desc')->paginate(5);
        return response()->json([
            'status' => true,
            'message' => 'Daftar Kategori',
            'data' => $categories
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $request->merge(['user_id' => auth()->user()->id]);
            $category = auth()->user()->categories()->create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambahkan data kategori baru',
                'data' => $category
            ],200);
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
        $category = Category::with('user')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil ditemukan!',
            'data' => $category
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $request->merge(['user_id' => auth()->user()->id]);
            $category->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Berhasil memperbaharui data kategori',
                'data' => $category
            ],200);
        } catch (Exception $e) {
            return response()->json([
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
        $category = Category::findOrFail($id);
        $temp = $category;
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus kategori '.$temp->name.'',
        ],200);
    }
}