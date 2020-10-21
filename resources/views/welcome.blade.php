<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>My Bookshelf</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <form id='fetchBooks' method="POST" {{--action="{{ route('fetchBooks') }}"--}}>
            @csrf
            <label> Find books
                <input name="term"/>
            </label>
        </form>
        <ul id="sort">
            <li data-sort="0">Title A-Z</li>
            <li data-sort="1">Title Z-A</li>
        </ul>
        <ul id="bookList">
        </ul>
    </body>
    <script src="{{ asset('js/manifest.js?v=1.0') }}"></script>
    <script src="{{ asset('js/app.js?v=1.0') }}"></script>
    <script src="{{ asset('js/vendor.js?v=1.0') }}"></script>
</html>
