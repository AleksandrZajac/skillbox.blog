@component('mail::message')
Итоговый отчет:
<ul>
        @if($data['report_news'])
            <li>Количество новостей {{ $data['report_news'] }}</li>
        @endif
        @if($data['report_articles'])
            <li>Количество  статей {{ $data['report_articles'] }}</li>
        @endif
        @if(is_int($data['report_comments']))
            <li>Количество коментариев {{ $data['report_comments'] }}</li>
        @endif
        @if($data['report_users'])
            <li>Количество пользователей {{ $data['report_users'] }}</li>
        @endif
        @if($data['report_tags'])
            <li>Количество тегов {{ $data['report_tags'] }}</li>
        @endif

</ul>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
