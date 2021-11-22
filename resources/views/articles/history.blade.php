@extends('layout')

@section('content')

<div class="col-md-8 blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        <a href="{{ route('articles.show', $article->slug) }}">Изменения статьи: {{ $article->title }}</a>
    </h3>
    <div class="blog-post">
        @php
            $arrayHistory = array_reverse($article->history->toArray());
        @endphp

        @forelse ($arrayHistory as $item)
        <p><b>Изменил статью: {{ $item['email'] }}</b></p>
        <p>{{ Carbon\Carbon::parse($item['pivot']['created_at'])->diffForHumans() }}</p>
        <p><i>Статья до изменения: </i></p>
        <p>{{ $item['pivot']['before'] }}</p>
        <p><i>Статья после изменения: </i></p>
        <p>{{ $item['pivot']['after'] }}</p>
        @empty
        <p>Нет истории изменения</p>
        @endforelse

    </div>
</div>

@endsection
