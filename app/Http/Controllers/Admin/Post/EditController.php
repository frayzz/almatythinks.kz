<?php

namespace App\Http\Controllers\Admin\Post;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use App\Tag;

class EditController extends BaseController
{
    public function __invoke(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }
}
