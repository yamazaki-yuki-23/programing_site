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
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                                background-image: url('/image/background.jpg');
                                /* color: #fff; */
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
            }
            #cover {
                    background-color: rgba(33,33,33,0.4); 
                    min-height: 100vh;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }
            .links > a {
                color: #ffffff;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border-bottom: solid 1px #fff;
                padding-top: 10px;
                padding-bottom: 10px;
                margin-left: 10px;
                margin-right: 10px;
            }
            .lonks > a:hover {
                    background-color: rgba(0,0,0,0.3);
            }
            .top > a {
                color: #ffffff;
                font-size: 18px;
                padding: 0 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                padding-top: 10px;
                padding-bottom: 10px;
                margin-left: 10px;
                margin-right: 10px;
            }
            #login,#register {
                color:black;
            }
        </style>
    </head>
    <body>
        <div id="cover">
            <div id="app">
                <div class="top-left top">
                    <a href="{{url('/') }}">TOPへ</a>
                </div>
                <div class="top-right links">
                    @auth
                        <!-- <a href="{{url('/home') }}">{{Auth::user()->name }}</a> -->
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
                        <a href="{{route('login') }}">ログイン</a>
                        <a href="{{route('register') }}">登録</a>
                    @endauth
                </div>
                <div class="py-5"></div>
                <main class="py-5">
                    @yield('content')
                </main>
                <div class="py-5"></div>
            </div>
        </div>
        <script src=" {{ mix('js/app.js') }} "></script>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    </body>
</html>