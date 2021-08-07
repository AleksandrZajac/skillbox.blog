@extends('layout')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Статьи
            </h3>

            <div class="blog-post">
                <h2 class="blog-post-title">{{ $item[0]->title }}</h2>
                {{ $item[0]->created_at->toFormattedDateString() }}
                <p>{{ $item[0]->description }}</p>
                <hr>
            </div><!-- /.blog-post -->
        </div>
    </div><!-- /.row -->
</main><!-- /.container -->

@endsection
