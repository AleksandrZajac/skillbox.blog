@extends('layout')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Статьи
            </h3>

            <div class="blog-post">
                @foreach($articles as $article)
                <h2 class="blog-post-title"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h2>
                <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

                <p>{{ $article->short_description }}</p>
                @endforeach
                <hr>
            </div><!-- /.blog-post -->
        </div><!-- /.row -->
</main><!-- /.container -->

@endsection
