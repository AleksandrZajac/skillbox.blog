@extends('layout')

@section('content')

    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Страница создания коментария</h2>

            @include('layouts.errors')
            @include('layouts.success')
                <form method="POST" action="{{ route('comments.store', $article->slug) }}">
                    @csrf
                    <div class="form-group">
                        <label for="description">Ваш комментарий</label>
                        <textarea class="form-control" name="description"
                            placeholder=""></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Создать комментарий</button>
                </form>
        </div>
    </div>


@endsection
