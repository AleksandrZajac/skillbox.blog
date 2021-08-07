@extends('layout')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">Контакты</h2>

                @include('layouts.errors')
                <form method="post" action="/contacts">
                @csrf
                    <div class="form-group">
                        <label for="email">Емайл</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <input type="text" class="form-control" name="message" id="message" value="{{ old('message') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div><!-- /.blog-post -->
        </div><!-- /.row -->
</main><!-- /.container -->

@endsection
