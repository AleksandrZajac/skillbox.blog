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
                @if($longestArticle)
                <p><b>Самая длинная статья: </b>{{ $longestArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $longestArticle->slug) }}">
                        {{ route('articles.show', $longestArticle->slug) }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $longestArticle->description_length }}</p>
                @else
                <p><b>Самая длинная статья: </b>Нет статей</p>
                <p><b>Ссылка на статью: </b></p>
                <p><b>Длина статьи в символах: </b></p>
                @endif
                <hr>
                @if($shortestArticle)
                <p><b>Самая короткая статья: </b>{{ $shortestArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $shortestArticle->slug) }}">
                        {{ route('articles.show', $shortestArticle->slug) }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $shortestArticle->description_length }}</p>
                @else
                <p><b>Самая короткая статья: </b>Нет статей</p>
                <p><b>Ссылка на статью: </b></p>
                <p><b>Длина статьи в символах: </b></p>
                @endif
                <hr>
                <p><b>Средние количество статей у активных пользователей: </b>{{ $averageNumberOfArticlesByActiveUsers }}</p>
                <hr>
                @if($mostVolatileArticle)
                <p><b>Самая непостоянная статья: </b>{{ $mostVolatileArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $mostVolatileArticle->slug) }}">
                        {{route('articles.show', $mostVolatileArticle->slug) }}
                    </a>
                </p>
                @else
                <p><b>Самая непостоянная статья: </b>Нет ни одной измененной статьи.</p>
                <p><b>Ссылка на статью: </b></p>
                @endif
                <hr>
                @if($mostDiscussedArticle)
                <p><b>Самая обсуждаемая статья: </b>{{ $mostDiscussedArticle->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $mostDiscussedArticle->slug) }}">
                        {{ route('articles.show', $mostDiscussedArticle->slug) }}
                    </a></p>
                @else
                <p><b>Самая обсуждаемая статья: </b>Нет ни одной обсуждаемой статьи</p>
                <p><b>Ссылка на статью: </b></p>
                @endif
                <hr>
            </div>
        </div>
    </div>
</main>

@endsection
