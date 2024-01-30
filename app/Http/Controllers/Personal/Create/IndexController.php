<?php

namespace App\Http\Controllers\Personal\Create;

use App\Category;
use App\Tag;
use App\User;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return view('personal.post.create', compact('user'));
    }
}
