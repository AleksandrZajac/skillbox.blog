@extends('layout')

@section('content')

<div class="col-md-8 blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Новости
    </h3>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="blog-post">
        @foreach($news as $newsItem)
        @admin
        <h2 class="blog-post-title"><a href="{{ route('admin.news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></h2>
        <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
        @else
        <h2 class="blog-post-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></h2>
        <p class="blog-post-meta">{{ $newsItem->created_at->toFormattedDateString() }}</p>
        @endadmin

        @endforeach
    </div>
    <div class="pt-5">
        {{ $news->links() }}
    </div>
</div>

@endsection
