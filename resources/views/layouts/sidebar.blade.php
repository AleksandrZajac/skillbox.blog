<aside class="col-md-4 blog-sidebar">
    <div class="p-3">
        <h4 class="font-italic">Теги статей</h4>
        <ol class="list-unstyled mb-0">
            @include('articles.tags', ['tags' => $articleTagsCloud])
        </ol>
        <h4 class="font-italic">Теги новостей</h4>
        <ol class="list-unstyled mb-0">
            @include('news.tags', ['tags' => $newsTagsCloud])
        </ol>
    </div>
</aside>
