<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $categories = Category::orderby('name', 'asc')->get();
        return view('article.index', compact('categories'));
    }
}