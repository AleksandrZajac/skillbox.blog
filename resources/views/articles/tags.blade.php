@php
    $tags = $tags ?? collect();
@endphp
<div>
    @foreach($tags as $tag)
        <a href="{{ route('tags.index', $tag->getRouteKey()) }}" class="badge badge-secondary">{{ $tag->name }}</a>
    @endforeach
</div>
