@extends('without_sidebar')

@section('content')

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                Портал статистики
            </h3>

            <div class="blog-post">
                <p><b>Количество статей: </b>{{ $articleStatistics['articlesCount'] }}</p>
                <hr>
                <p><b>Количество новостей: </b>{{ $newsCount }}</p>
                <hr>
                <p><b>ФИО автора, у которого больше всего статей на сайте: </b>{{ $articleStatistics['userNameWhereArticleCountMax'] }}</p>
                <hr>
                @if($articleStatistics['longestArticle'])
                <p><b>Самая длинная статья: </b>{{ $articleStatistics['longestArticle']->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $articleStatistics['longestArticle']->slug) }}">
                        {{ route('articles.show', $articleStatistics['longestArticle']->slug) }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $articleStatistics['longestArticle']->description_length }}</p>
                @else
                <p><b>Самая длинная статья: </b>Нет статей</p>
                <p><b>Ссылка на статью: </b></p>
                <p><b>Длина статьи в символах: </b></p>
                @endif
                <hr>
                @if($articleStatistics['shortestArticle'])
                <p><b>Самая короткая статья: </b>{{ $articleStatistics['shortestArticle']->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $articleStatistics['shortestArticle']->slug) }}">
                        {{ route('articles.show', $articleStatistics['shortestArticle']->slug) }}
                    </a>
                </p>
                <p><b>Длина статьи в символах: </b>{{ $articleStatistics['shortestArticle']->description_length }}</p>
                @else
                <p><b>Самая короткая статья: </b>Нет статей</p>
                <p><b>Ссылка на статью: </b></p>
                <p><b>Длина статьи в символах: </b></p>
                @endif
                <hr>
                <p><b>Средние количество статей у активных пользователей: </b>{{ $articleStatistics['averageNumberOfArticlesByActiveUsers'] }}</p>
                <hr>
                @if($articleStatistics['mostVolatileArticle'])
                <p><b>Самая непостоянная статья: </b>{{ $articleStatistics['mostVolatileArticle']->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $articleStatistics['mostVolatileArticle']->slug) }}">
                        {{route('articles.show', $articleStatistics['mostVolatileArticle']->slug) }}
                    </a>
                </p>
                @else
                <p><b>Самая непостоянная статья: </b>Нет ни одной измененной статьи.</p>
                <p><b>Ссылка на статью: </b></p>
                @endif
                <hr>
                @if($articleStatistics['mostDiscussedArticle'])
                <p><b>Самая обсуждаемая статья: </b>{{ $articleStatistics['mostDiscussedArticle']->title }}</p>
                <p><b>Ссылка на статью: </b>
                    <a href="{{ route('articles.show', $articleStatistics['mostDiscussedArticle']->slug) }}">
                        {{ route('articles.show', $articleStatistics['mostDiscussedArticle']->slug) }}
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
