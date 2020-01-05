<!DOCTYPE html>
<html lang="{{app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--csrf token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js" async></script>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </head>
    <body>
        <div id="cover">
            <div id="app" v-cloak>
                <div class="header">
                    <div class="top-left top">
                        <a class="zoom"　href="{{url('/') }}">TOPへ</a>
                    </div>
                    <div class="top-right links">
                        @auth
                            <div class="mr-5">
                                <div class="dropdown">
                                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; font-size:1.5em;">
                                        <span style="color:white;">{{Auth::user()->name }}</span>
                                    </a>

                                    <div class="dropdown-menu mr-4">
                                        <a class="dropdown-item" href="{{route('mypage') }}">マイページ</a>
                                        <a class="dropdown-item" href="{{route('getLogout') }}">ログアウト</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a class="zoom"　href="{{route('login') }}" style="font-size:1vw;">ログイン</a>
                            <a class="zoom"　href="{{route('register') }}" style="font-size:1vw;">登録</a>
                        @endauth
                    </div>
                </div>
                <div class="py-5"></div>
                <main class="py-5">
                    @yield('content')
                </main>
            </div>
        </div>
        <script>
             @if (session('msg_success'))
                $(function () {
                    toastr.success('{{ session('msg_success') }}');
                });
            @endif

            $(function() {
                marked.setOptions({
                    langPrefix: '',
                    breaks : true,
                    sanitize: true,
                });

                var target = $('.item-body')
                var html = marked(getHtml(target.html()));
                $('.item-body').html(html);

                function getHtml(html) {
                    html = html.replace(/&lt;/g, '<');
                    html = html.replace(/&gt;/g, '>');
                    html = html.replace(/&amp;/g, '&');
                    return html;
                }
            });

        </script>
        <script src=" {{ mix('js/app.js') }} "></script>
        <style>
            [v-cloak] {
            display: none;
            }
        </style>
    </body>
</html>
