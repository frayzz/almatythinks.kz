<?php

namespace App\Http\Controllers\Post\Comment;



use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Request $request, Post $post)
    {
        if ($request->ajax()) {
            // Здесь вы можете выполнить логику загрузки комментариев для данного поста
            $comments = Comment::where('post_id', $post->id)->with('user')->get(); // Пример запроса, замените на ваш запрос
            return response()->json(['comments' => $comments]);
        }

        return abort(404); // Обработка нормальных (не-AJAX) запросов, например, можно вернуть страницу 404
    }

    public function store(Request $request, Post $post)
    {
        // Валидация данных
        $request->validate([
            'message' => 'required',
        ]);

        // Создание нового комментария
        $comment = new Comment();
        $comment->post_id = $request->input('post_id');
        $comment->user_id = auth()->user()->id; // Предполагается, что комментарий создается текущим пользователем
        $comment->message = $request->input('message');
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }
}
