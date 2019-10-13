<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                color: #fff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            #cover {
                    background-color: rgba(33,33,33,0.4);
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
            .lonks >　a:hover {
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

            .m-b-md {
                margin-bottom: 30px;
            }

            a {
                display: inline-block;
                transition: .3s;
                -webkit-transform: scale(1);
                transform: scale(1);
                }
                a:hover {
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }
        </style>
    </head>
    <body style="background-image: url('/image/background.jpg')">
        <div id="cover" class="flex-center position-lef full-height">
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
                    <a href="{{route ('login') }}">ログイン</a>
                    <a href="{{route('register') }}">登録</a>
                @endauth
            </div>
            <div class="content">
                <div class="title m-b-md">
                    TECHQUE    
                </div>
                    <div class="m-b-md">
                        TECHQUEはプログラミング学習で生じる疑問・問題を解決し、理解を深めるサービスです。
                    </div>
                <div class="links">
                    <a href="{{route('young') }}" style="hover:red">質問を見る</a>
                    <a href="{{route('young-add') }}">質問を投稿する</a>
                </div>
            </div>
        </div>
        <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>
