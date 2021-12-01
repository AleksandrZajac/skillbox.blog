@extends('without_sidebar')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Портал статистики
            </h3>

            <div class="blog-post">
            @foreach($collection as $collectionItem)
                @foreach($collectionItem as $key => $value)
                    <p><b>{{ $key }}</b>  {{ $value }}</p>
                @endforeach
            @endforeach
            </div>
        </div>
    </div>
</main>

@endsection
