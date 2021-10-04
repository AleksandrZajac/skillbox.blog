@extends('without_sidebar')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Список обращений
            </h3>
            <div class="blog-post">
                @foreach($contacts as $contact)
                <h2 class="blog-post-title">{{ $contact->email }}</a></h2>
                <p class="blog-post-meta">{{ $contact->created_at->format('d.m.Y H:i:s') }}</p>
                <p>{{ $contact->message }}</p>
                @endforeach
                <hr>
            </div>
        </div><!-- /.blog-post -->
    </div><!-- /.row -->
</main><!-- /.container -->

@endsection
