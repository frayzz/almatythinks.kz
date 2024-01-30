@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <section class="featured-posts-section">
            <div class="row">
                @foreach( $posts as $post )
				<div class="col-md-4">
                <div class="card p-3 m-2" style="border-radius: 20px;" data-aos="fade-bottom">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle mr-3"></i>
                        <p class="blog-post-category m-0">{{ ($post->anonim != '1') ? $post->user->name : 'Анонимный пользователь' }}</p>
                    </div>

                    <p class="blog-post-text mt-3">{{ $post->content }}</p>
                    <div class="d-flex align-items-center">
                        @auth()
                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 p-0 bg-transparent">
                                @if(auth()->user()->likedPosts->contains($post->id))
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>
                                @endif
                            </button>
                        </form>
                        @endauth
                        @guest()
                            <a href="{{ route('login') }}" style="color: black">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        @endguest
                        <div class="ml-2">{{ $post->liked_users_count }}</div>
                        <div class="d-flex align-items-center comment_list" data-post-id="{{ $post->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: black">
                            <i class="far fa-comment ml-3"></i>
                            <div class="ml-2">{{ $post->comments->count() }}</div>
                        </div>
                    </div>
                </div>
				</div>
                @endforeach
            </div>
        </section>

    </div>

</main>
<!-- Модальное окно -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Комментарий</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">

                <div class="user_comment">

                </div>

            </div>
            <div class="modal-footer">
                <!--
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Ваш комментарии" aria-label="Ваш комментарии"
                           aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">Отправить</button>
                </div>
                -->
                @if (auth()->check()) <!-- Проверка, что пользователь аутентифицирован -->
                <form method="post" class="input-group mb-3" action="{{ route('post.comments.store', $post->id) }}">
                    @csrf

                        <input type="text" class="form-control" name="message" placeholder="Ваш комментарии" aria-label="Ваш комментарии"
                               aria-describedby="button-addon2">
                        <button type="submit" class="btn btn-primary" id="button-addon2">Отправить</button>
                        <div class="form_comment_send"></div>
                </form>
                @else
                    <p>Чтобы добавить комментарий, вам необходимо <a href="{{ route('login') }}">войти</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!-- Ваш JavaScript-скрипт -->
<script>
    $(document).ready(function () {
        // Обработка клика на иконку комментариев
        $('.comment_list').on('click', function () {
            var postId = $(this).data('post-id');
            var commentsContainer = $(this).siblings('.modal-body');

            // Выполнение AJAX-запроса для загрузки комментариев
            $.ajax({
                url: '/posts/'+postId+'/comments/',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    var comments = response.comments;
                    var commentHtml = '';

                    $.each(comments, function (index, comment) {
                        commentHtml += '<div class="user_comment p-2 border-bottom"><div class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" /><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" /></svg><div class="user_name pl-1">'+ comment.user.name + '</div><div class="date font-monospace text-muted pl-2"><small><i>'+'</i></small></div></div><div class="message">' + comment.message + '</div></div>';
                        post_comment_id = comment.post_id;
                    });

                    $('.modal-body').html(commentHtml);
                    $('.form_comment_send').html('<input type="hidden" class="set_post_id" name="post_id" value="'+postId+'">')
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection
