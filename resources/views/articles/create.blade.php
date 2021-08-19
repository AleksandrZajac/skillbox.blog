@extends('layout')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">Страница создания статьи</h2>

                @include('layouts.errors')
                        <form method="POST" action="{{ route('articles.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="articleName">Символьный код</label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                            </div>
                            <div class="form-group">
                                <label for="articleName">Название статьи</label>
                                <input type="text" class="form-control" name="title" id="articleName"
                                    value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="shortDescription">Краткое описание статьи</label>
                                <input type="text" class="form-control" name="short_description" id="shortDescription"
                                    value="{{ old('short_description') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Детальное описание статьи</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="isPublished" name="is_published"
                                    value="1">
                                <label class="form-check-label" for="isPublished">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
            </div><!-- /.blog-post -->
        </div><!-- /.row -->
</main><!-- /.container -->

@endsection
