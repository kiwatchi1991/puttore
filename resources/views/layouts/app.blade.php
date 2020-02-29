
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

    {{-- slick(カルーセルのプラグイン) --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    {{-- // Add the new slick-theme.css if you want the default styling --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div >
        <nav class="header">
            <div class="header__inner">
                <a class="" href="{{ url('/products/mypage') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class=""></span>
                </button>

                <div class="" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="">

                    </ul>
                   
                    <!-- Right Side Of Navbar -->
                    <ul class="">
                        <div>

                            <nav class="global-nav">
                             <ul class="global-nav__list">
                                 
                                 @auth
                                 ユーザーID:{{ $user->id }}　メールアドレス{{ $user->email }}
                                 @endauth

                               <li class="global-nav__item"><a href="{{ route('products.new') }}">New</a></li>
                               <li class="global-nav__item"><a href="{{ route('products') }}">index</a></li>
                             <li class="global-nav__item"><a href=" {{ route('products.mypage') }}" >mypage</a></li>
                             <li class="global-nav__item"><a href=" {{ route('bords') }}" >bords</a></li>
                             <li class="global-nav__item"><a href=" {{ route('carts') }}" >carts</a></li>
                             <li class="global-nav__item"><a href=" {{ route('contact.index') }}" >contacts</a></li>
                               <li class="global-nav__item">
                           
                                 <a onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Logout</a>
                                 {{-- <form action="/logout" method="POST" id="logout__form" style="display:none;"></form> --}}
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                               </li>
                               <li>
                                @guest
                                <li class="global-nav__item">
                                    <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="global-nav__item">
                                        <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    @endguest
                               </li>
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
               
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="" aria-labelledby="navbarDropdown">
                                    <a class="" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li> --}}
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>

</body>
</html>
