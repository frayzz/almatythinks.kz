<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::where('publication', 1)
                     ->orderBy('created_at', 'desc') // Сортировка по убыванию
                     ->get();
        return view('main.index', compact('posts'));
    }
}
