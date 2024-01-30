<?php

namespace App\Http\Controllers\Admin\Post;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\PublicateRequest;
use App\Tag;
use App\User;

class PublicateController extends BasepublishController
{
    public function __invoke(PublicateRequest $request, Post $post)
    {
        $data = $request->validated();
        $this->service->update($data, $post);


        $data = [];
        $data['usersCount'] = User::all()->count();
        $data['posts'] = Post::where('publication', 0)->get();
        $data['postsCount'] = Post::all()->count();
        $data['categoriesCount'] = Category::all()->count();
        $data['tagsCount'] = Tag::all()->count();

        return view('admin.main.index', compact('data'));
    }
}
