@extends('without_sidebar')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Портал статистики
            </h3>

            <div class="blog-post">
                <p><b>Количество статей: </b>{{ $articlesCount }}</p>
                <hr>
                <p><b>Количество новостей: </b>{{ $newsCount }}</p>
                <hr>
                <p><b>ФИО автора, у которого больше всего статей на сайте: </b>{{ $userNameWhereArticleCountMax }}</p>
                <hr>
                <p><b>Самая длинная статья: </b>{{ $longestArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $longestArticle->slug) }}">
                        {{ $longestArticle->slug ? route('articles.show', $longestArticle->slug) : '' }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $longestArticle->description_length }}</p>
                <hr>
                <p><b>Самая короткая статья: </b>{{ $shortestArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $shortestArticle->slug) }}">
                        {{ $shortestArticle->slug ? route('articles.show', $shortestArticle->slug) : '' }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $shortestArticle->description_length }}</p>
                <hr>
                <p><b>Средние количество статей у активных пользователей: </b>{{ $averageNumberOfArticlesByActiveUsers }}</p>
                <hr>
                <p><b>Самая непостоянная статья: </b>{{ $mostVolatileArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $mostVolatileArticle->slug) }}">
                        {{ $mostVolatileArticle->slug ? route('articles.show', $mostVolatileArticle->slug) : '' }}
                    </a>
                </p>
                <hr>
                <p><b>Самая обсуждаемая статья: </b>{{ $mostDiscussedArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $mostDiscussedArticle->slug) }}">
                        {{ $mostDiscussedArticle->slug ? route('articles.show', $mostDiscussedArticle->slug) : '' }}
                    </a></p>
                <hr>
            </div>
        </div>
    </div>
</main>

@endsection
