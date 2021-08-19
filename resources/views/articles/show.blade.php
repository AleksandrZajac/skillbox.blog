@extends('layout')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Статьи
            </h3>

            <div class="blog-post">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
                {{ $article->created_at->toFormattedDateString() }}
                <p>{{ $article->description }}</p>
                <a class="p-2 text-muted" href="{{ route('articles.edit', $article->id) }}">Редактировать статью</a>
                <hr>
            </div><!-- /.blog-post -->
        </div>
    </div><!-- /.row -->
</main><!-- /.container -->

@endsection
