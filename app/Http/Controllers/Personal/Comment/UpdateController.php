<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Category;
use App\Comment;
use App\Http\Requests\Personal\Comment\UpdateRequest;
use App\Tag;
use App\User;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);
        return redirect()->route('personal.comment.index');
    }
}
