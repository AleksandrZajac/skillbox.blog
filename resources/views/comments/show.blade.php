@foreach($article->comments as $comment)
    <p>{{ $comment->description }}</p>
    <p class="blog-post-meta">{{ $comment->created_at }} <b>{{ $comment->user->name }}</b></p>
    <hr>
@endforeach
