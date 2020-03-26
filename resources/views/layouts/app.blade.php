<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ぷっとれ | @yield('title')</title>
  <link rel="icon" href="/storage/images/fav.ico"> <!-- Scripts -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

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
  <nav class="header">
    <div class="header__inner">
      <div class="header__logo">
        <div class="c-top__fvMsg--img c-top__fvMsg--img--logo">
          <a class="" href="{{ url('/') }}">
            <img src="/storage/images/logo.png" alt="ぷっとれ" width="120">
          </a>
        </div>
        <div class="c-top__fvMsg--img--pc c-top__fvMsg--img--pcLogo">
          <a class="" href="{{ url('/') }}">
            <img src="/storage/images/logo_white.png" alt="ぷっとれ" width="150">
          </a>
        </div>
      </div>

      <div class="" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="">
          <div>

            <nav class="global-nav">
              <div class="global-nav__logo">
                <div class="c-top__fvMsg--img">
                  <a class="" href="{{ url('/') }}">
                    <img src="/storage/images/logo.png" alt="ぷっとれ" width="120">
                  </a>
                </div>
                <div class="c-top__fvMsg--img--pc">
                  <a class="" href="{{ url('/') }}">
                    <img src="/storage/images/logo.png" alt="ぷっとれ" width="150">
                  </a>
                </div>
              </div>
              <ul class="global-nav__list">

                @auth

                <li class="global-nav__item global-nav__item--profile">
                  <a href="{{ route('mypage') }}" class="global-nav__item__link lobal-nav__item__link--profile">
                    <div class="global-nav__item__profile">
                      <div class="global-nav__item__profile__img__wrapper">
                        @if($user->pic)
                        <img class="global-nav__item__profile__img" {{-- src="{{ /storage/ $user->pic  }}" alt=""> --}}
                        src="/storage/{{ $user->pic }}" alt="">
                        @endif
                      </div>
                      <span class="global-nav__item__profile__name">{{ $user->account_name }}</span>
                    </div>
                  </a></li>
                @endauth

                <li class="global-nav__item">
                  <a href="{{ route('products') }}" class="global-nav__item__link @guest first @endguest">作品を探す</a>
                </li>
                <li class="global-nav__item">
                  <a href="{{ route('products.new') }}" class="global-nav__item__link">出品する</a>
                </li>
                @auth
                <li class="global-nav__item">
                  <a href=" {{ route('mypage') }}" class="global-nav__item__link">マイページ</a>
                </li>
                <li class="global-nav__item">
                  <a href=" {{ route('bords') }}" class="global-nav__item__link">メッセージボード</a>
                </li>
                <li class="global-nav__item">
                  <a onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                    href="{{ route('logout') }}" class="global-nav__item__link">ログアウト</a>
                  {{-- <form action="/logout" method="POST" id="logout__form" style="display:none;"></form> --}}
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li>
                @endauth
                @guest
                <li class="global-nav__item global-nav__item--auth first">
                  <a href=" {{ route('login') }}" class="global-nav__item__link auth">ログイン</a>
                </li>
                <li class="global-nav__item global-nav__item--auth">
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

      <div class="global-nav__pc">
        <nav class="global-nav__pc--wrap">
          <ul class="global-nav__pc--list">
            @auth
            <li class="">
              <a href="{{ route('mypage') }}" class="global-nav__item__link lobal-nav__item__link--profile">
                <div class="global-nav__item__profile">
                  <div class="global-nav__pc__profile__img__wrapper">
                    @if($user->pic)
                    <img class="global-nav__pc__profile__img" src="/storage/{{ $user->pic }}" alt="">
                    @endif
                  </div>
                </div>
              </a></li>

            @endauth
            @auth
            <li class="">
              <a href=" {{ route('bords') }}" class="global-nav__item__link">メッセージボード</a>
            </li>

            @endauth

            <li class="">
              <a href="{{ route('products.new') }}" class="global-nav__item__link">出品する</a>
            </li>
            <li class="">
              <a href="{{ route('products') }}" class="global-nav__item__link @guest first @endguest">作品を探す</a>
            </li>

            @guest
            <li class="">
              <a href=" {{ route('login') }}" class="global-nav__item__link">ログイン</a>
            </li>
            <li>
              <a href=" {{ route('register') }}" class="global-nav__item__link">新規登録</a>
            </li>
            @endguest
          </ul>
        </nav>
      </div>

    </div>




  </nav>



  {{-- フラッシュメッセージ --}}
  @if (session('flash_message'))
  <div class="c-header__sessionMessage js-sessionMessage" style="display: none;">
    {{ session('flash_message') }}
  </div>
  @endif

  <main class="py-4">
    @yield('content')
  </main>
  <footer id="footer">
    <div class="c-footer__inner">
      <div class="c-footer__logo">
        <div class="c-top__fvMsg--img">
          <a class="" href="{{ url('/') }}">
            <img src="/storage/images/logo.png" alt="ぷっとれ" width="120">
          </a>
        </div>
        <div class="c-footer__logo--img">
          <a class="" href="{{ url('/') }}">
            <img src="/storage/images/logo.png" alt="ぷっとれ" width="120">
          </a>
        </div>
      </div>
      <div class="c-footer__list">
        <ul class="c-footer__list__wrap">
          <li><a class="c-footer__list__link" href="/#features">ぷっとれについて</a></li>
          <li><a class="c-footer__list__link" href="/home/agreement">利用規約</a></li>
          <li><a class="c-footer__list__link" href="/home/policy">プライバシーポリシー</a></li>
          <li><a class="c-footer__list__link" href="/home/tokutei">特定商取引法に基づく表示</a></li>
          <li><a class="c-footer__list__link" href="{{ route('contact.index') }}">お問い合わせ</a></li>
        </ul>
        <p class="c-footer__small"><small>©︎2020 ぷっとれ</small></p>
      </div>
    </div>
  </footer>
  {{-- </div> --}}
  <script src="{{ asset('js/app.js') }}"></script>
  {{-- <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>
    src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"
  </script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js">
  </script>

</body>

</html>