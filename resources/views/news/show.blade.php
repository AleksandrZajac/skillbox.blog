@extends('layout')

@section('content')

<div class="col-md-8 blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Новость
    </h3>
    <div class="blog-post">

        <h2 class="blog-post-title">{{ $news->title }}</h2>
        {{ $news->created_at->toFormattedDateString() }}
        <p>{{ $news->description }}</p>

        <h3>Коментарии</h3>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="blog-post">
            @include('comments.news.show')
        </div>
        @auth
        <h5 class="pt-2">
            <a class="btn btn-success" href="{{ route('news.comments.create', $news->id) }}">
                Оставить коментарий
                <a>
        </h5>
        @endauth
        @admin
        <h5 class="pt-2">
            <a class="btn btn-primary" href="{{ route('admin.news.edit', $news->id) }}">
                Редактировать новость
                <a>
        </h5>
        <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Стереть новость</button>
        </form>
        @endadmin
    </div>
</div>

@endsection
