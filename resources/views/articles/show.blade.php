@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <div class="row">
                <div class="col-md-8 blog-main">
                    <h3 class="pb-3 mb-4 font-italic border-bottom">
                        Статьи
                    </h3>
                    <div class="blog-post">
                        <h2 class="blog-post-title">{{ $article->title }}</h2>
                        {{ $article->created_at->toFormattedDateString() }}
                        <p>{{ $article->description }}</p>
                        @include('articles.tags', ['tags' => $article->tags])
                        <h3>Коментарии</h3>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="blog-post">
                            @foreach($comments as $comment)
                            </h2>
                            <p>{{ $comment->description }}</p>
                            <p class="blog-post-meta">{{ $comment->created_at }}</p>
                            <hr>
                            @endforeach
                        </div>
                        @auth
                        <h5 class="pt-2">
                            <a class="btn btn-success" href="{{ route('comments.create', $article->slug) }}">
                                Оставить коментарий
                            <a>
                        </h5>
                        @endauth
                        @can('update', $article)
                        @admin
                        <h5 class="pt-2">
                            <a class="btn btn-primary" href="{{ route('admin.articles.edit', $article->slug) }}">
                                Редактировать статью
                            <a>
                        </h5>
                        @else
                        <h5 class="pt-2">
                            <a class="btn btn-primary" href="{{ route('articles.edit', $article->slug) }}">
                                Редактировать статью
                            <a>
                        </h5>
                        @endadmin
                        @endcan
                        @can('delete', $article)
                        <form action="{{ route('articles.destroy', $article->slug)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Стереть задачу</button>
                        </form>
                        @endcan
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
