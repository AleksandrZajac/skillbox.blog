@extends('layout')

@section('content')

<main role="main" class="container">
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
                            <h5 class="pt-2"><a class="btn btn-primary"
                                    href="{{ route('articles.edit', $article->slug) }}">Редактировать статью<a></h5>
                            <form action="{{ route('articles.destroy', $article->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Стереть задачу</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.sidebar')
</main>

@endsection
