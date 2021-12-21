@extends('without_sidebar')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Новый отчет
                </h3>
                <form method="POST" action="{{ route('admin.general.reports.send') }}">
                    @csrf
                    <div class="form-check">
                        <label for="report_news" class="form-check-label">
                            <input class="form-check-input" name="report_news" type="hidden" value="0">
                            <input class="form-check-input" type="checkbox" id="report_news" name="report_news" value="1">
                            Количество новостей
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="report_articles" class="form-check-label">
                            <input class="form-check-input" name="report_articles" type="hidden" value="0">
                            <input class="form-check-input" type="checkbox" id="report_articles" name="report_articles" value="1">
                            Количество статей
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="report_comments" class="form-check-label">
                            <input class="form-check-input" name="report_comments" type="hidden" value="0">
                            <input class="form-check-input" type="checkbox" id="report_comments" name="report_comments" value="1">
                            Количество коментариев
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="report_tags" class="form-check-label">
                            <input class="form-check-input" name="report_tags" type="hidden" value="0">
                            <input class="form-check-input" type="checkbox" id="report_tags" name="report_tags" value="1">
                            Количество тегов
                        </label>
                    </div>
                    <div class="form-check">
                        <label for="report_users" class="form-check-label">
                            <input class="form-check-input" name="report_users" type="hidden" value="0">
                            <input class="form-check-input" type="checkbox" id="report_users" name="report_users" value="1">
                            Количество пользователей
                        </label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Генерировать отчет</button>
                </form>
                </div>
            </div>
    </main>

@endsection
