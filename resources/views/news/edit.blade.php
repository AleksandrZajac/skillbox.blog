@extends('layout')

@section('content')

<div class="col-md-8 blog-main">
    <div class="blog-post">

        @include('layouts.errors')
        @include('layouts.success')

        @if(isset($news->id))
        <h2 class="blog-post-title">Страница редактирования новости</h2>
        <form method="POST" action="{{ route('admin.news.update', $news->id) }}">
            @method('PATCH')
            @else
            <h2 class="blog-post-title">Страница создания новости</h2>
            <form method="POST" action="{{ route('admin.news.store') }}">
                @endif
                @csrf
                <div class="form-group">
                    <label for="newsName">Название статьи</label>
                    <input type="text" class="form-control" name="title" id="newsName" value="{{ old('title', $news->title) }}">
                </div>
                <div class="form-group">
                    <label for="description">Детальное описание статьи</label>
                    <textarea class="form-control" id="description" name="description" placeholder="">{{ old('description', $news->description) }}</textarea>
                </div>
                <div class="form-group form-check">
                    <input name="is_published" type="hidden" value="0">
                    <input type="checkbox" id="is_published" name="is_published" value="1" @if( old('is-published', $news->is_published) )
                    checked="checked"
                    @endif>
                    <label for="completed">Опубликовать</label>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
    </div>
</div>


@endsection
