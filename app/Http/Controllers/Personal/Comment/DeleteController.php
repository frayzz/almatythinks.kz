<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Category;
use App\Comment;
use App\Tag;
use App\User;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $comments = delete();
        return view('personal.comment.index', compact('comments'));
    }
}
