@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Страница создания статьи</h2>

            @include('layouts.errors')

            @if(isset($article->slug))
            <form method="POST" action="{{ route('articles.update', $article->slug) }}">
                @method('PATCH')
                @else
                <form method="POST" action="{{ route('articles.store') }}">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="articleName">Символьный код</label>
                        @if($article->id)
                        <input type="hidden" class="form-control" name="id" id="id" value="{{ $article->id }}">
                        @endif
                        <input type="text" class="form-control" name="slug" id="slug"
                            value="{{ old('slug', $article->slug) }}">
                    </div>
                    <div class="form-group">
                        <label for="articleName">Название статьи</label>
                        <input type="text" class="form-control" name="title" id="articleName"
                            value="{{ old('title', $article->title) }}">
                    </div>
                    <div class="form-group">
                        <label for="shortDescription">Краткое описание статьи</label>
                        <input type="text" class="form-control" name="short_description" id="shortDescription"
                            value="{{ old('short_description', $article->short_description) }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Детальное описание статьи</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="">{{ old('description', $article->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputTags">Добавить тег</label>
                        <input type="text" class="form-control" id="inputTags" name="tags"
                            value="{{ old('tags', $article->tags->pluck('name')->implode(',')) }}">
                    </div>
                    <div class="form-group form-check">
                        <input name="is_published" type="hidden" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" @if( old('is-published',
                            $article->is_published) )
                        checked="checked"
                        @endif>
                        <label for="completed">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
        </div>
    </div>


    @endsection
