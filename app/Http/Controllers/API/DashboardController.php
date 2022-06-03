<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalCategories = Category::count();
        $totalArticle = Article::count();
        $totalUser = User::count();
        return response()->json([
            'status' => true,
            'data' => [
                'categories' => $totalCategories,
                'articles' => $totalArticle,
                'users' => $totalUser,
            ]
        ]);
    }
}