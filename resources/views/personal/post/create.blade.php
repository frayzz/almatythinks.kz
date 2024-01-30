@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <form action="{{ route('personal.create.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" style="border: 1px solid #d3d3d3"
                          name="content">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="text-danger">Это поле необходимо для заполнения {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" placeholder="Название поста"
                           value="{{ Auth::id() }}">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="anonimPostCheck" name="anonim" value="1">
                    <label class="form-check-label" for="anonimPostCheck">Анонимный пост( Пост будет отвязан от вас )</label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Отправить">
                </div>
            </form>
        </div>
    </main>
@endsection
