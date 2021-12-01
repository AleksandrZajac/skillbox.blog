@extends('layout')

@section('content')

<div class="col-md-8 blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Статьи
    </h3>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="blog-post">
        @foreach($articles as $article)
        <h2 class="blog-post-title"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
        </h2>
        <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

        <p>{{ $article->short_description }}</p>
        @include('articles.tags', ['tags' => $article->tags])
        @endforeach
    </div>
    <div class="pt-5">
        @if(method_exists($articles, 'links'))
            {{ $articles->links() }}
        @endif
    </div>
</div>

@endsection
