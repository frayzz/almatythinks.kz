<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Category;
use App\Tag;
use App\User;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Post $post)
    {
        $posts = auth()->user()->likedPosts()->detach($post->id);
        return redirect()->route('personal.liked.index');
    }
}
