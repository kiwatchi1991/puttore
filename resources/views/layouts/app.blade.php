<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    {{-- slick(カルーセルのプラグイン) --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}" /> --}}
    {{-- // Add the new slick-theme.css if you want the default styling --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}" /> --}}

    {{-- Datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/vader/jquery-ui.min.css">

    {{-- マークダウン --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">

    {{-- Cropper（画像トリミング） --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.0.0/cropper.min.css" rel="stylesheet" type="text/css"
        media="all" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div>
        <nav class="header">
            <div class="header__inner">
                <div class="header__logo">
                    <a class="" href="{{ url('/') }}">
                        <img src="/storage/images/logo.png" alt="ぷっとれ" width="120">
                    </a>
                </div>

                <div class="" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="">
                        <div>

                            <nav class="global-nav">
                                <ul class="global-nav__list">

                                    @auth

                                    <li class="global-nav__item global-nav__item--profile">
                                        <a href="{{ route('profile.show',$user->id) }}"
                                            class="global-nav__item__link lobal-nav__item__link--profile">
                                            <div class="global-nav__item__profile">
                                                <div class="global-nav__item__profile__img__wrapper">
                                                    @if($user->pic)
                                                    <img class="global-nav__item__profile__img"
                                                        {{-- src="{{ /storage/ $user->pic  }}" alt=""> --}}
                                                    src="/storage/{{ $user->pic }}" alt="">
                                                    @endif
                                                </div>
                                                <span
                                                    class="global-nav__item__profile__name">{{ $user->account_name }}</span>
                                            </div>
                                        </a></li>
                                    @endauth

                                    <li class="global-nav__item">
                                        <a href="{{ route('products') }}"
                                            class="global-nav__item__link @guest first @endguest">作品を見る</a>
                                    </li>
                                    <li class="global-nav__item">
                                        <a href="{{ route('products.new') }}" class="global-nav__item__link">出品する</a>
                                    </li>
                                    @auth
                                    <li class="global-nav__item">
                                        <a href=" {{ route('profile.show',$user->id) }}"
                                            class="global-nav__item__link">マイページ</a>
                                    </li>
                                    <li class="global-nav__item">
                                        <a href=" {{ route('bords') }}" class="global-nav__item__link">メッセージボード</a>
                                    </li>
                                    <li class="global-nav__item">
                                        <a onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                            href="{{ route('logout') }}" class="global-nav__item__link">ログアウト</a>
                                        {{-- <form action="/logout" method="POST" id="logout__form" style="display:none;"></form> --}}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @endauth
                                    @guest
                                    <li class="global-nav__item">
                                        <a href=" {{ route('login') }}" class="global-nav__item__link auth">ログイン</a>
                                        <a href=" {{ route('register') }}" class="global-nav__item__link auth">新規登録</a>
                                    </li>
                                    @endguest
                                </ul>
                            </nav>
                            <div class="hamburger" id="js-hamburger">
                                <span class="hamburger__line hamburger__line--1"></span>
                                <span class="hamburger__line hamburger__line--2"></span>
                                <span class="hamburger__line hamburger__line--3"></span>
                            </div>
                            <div class="black-bg" id="js-black-bg">
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"
    </script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    {{-- Copper（画像トリミング）読み込み --}}
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.6/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.6/cropper.min.js"></script>
</body>

</html>