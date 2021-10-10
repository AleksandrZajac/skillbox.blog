@component('mail::message')
# Список статей.

@each('mail.article_item', $articles, 'article', 'mail.article_empty')

Thanks,<br>
{{ config('app.name') }}
@endcomponent
