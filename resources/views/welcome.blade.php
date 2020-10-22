<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>My Bookshelf</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>
    <body>
        <h1><a href="">My Bookshelf</a></h1>
        <div id="home">
            <form id='fetchBooks' method="POST" {{--action="{{ route('fetchBooks') }}"--}}>
                @csrf
                <label>
                    <input name="term" placeholder="Find books"/>
                </label>
            </form>
            <ul id="sort">
                <li data-sort="0"><a href="">Title A-Z</a></li>
                <li data-sort="1"><a href="">Title Z-A</a></li>
            </ul>
            <ul id="bookList">
            </ul>
        </div>
        <div id="bookInfo" class="hide">
            <table></table>
        </div>
    </body>
    <script src="{{ asset('js/manifest.js?v=1.0') }}"></script>
    <script src="{{ asset('js/app.js?v=1.0') }}"></script>
    <script src="{{ asset('js/vendor.js?v=1.0') }}"></script>
</html>
