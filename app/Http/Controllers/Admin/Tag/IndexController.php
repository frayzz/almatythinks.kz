<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Category;
use App\Http\Controllers\Controller;
use App\Tag;

class IndexController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }
}
