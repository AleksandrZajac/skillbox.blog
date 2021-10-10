<p>{{$article->title}}</p>

@component('mail::button', ['url' => route('articles.show', $article->slug)])
Прочитать статью.
@endcomponent
