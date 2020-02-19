@extends('layouts.app')

@section('content')

        <section class="login">
            <div class="l-auth__inner">
                <div class="c-pageTitle">ログイン</div>

                <div class="l-auth__formArea">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="c-input__area">
                            <label for="email" class="">メールアドレス</label>

                            <div class="">
                                <input id="email" type="email" class="c-input__form @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="c-input__area c-input__area--password">
                            <label for="password" class="">パスワード</label>

                            <div class="">
                                <input id="password" type="password" class="c-input__form @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="c-input__remember">
                            <input class="" type="checkbox" class="login__input-area" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="">
                            <div class="c-button__block">
                                <button type="submit" class="c-button">
                                    ログイン
                                </button>

                            </div>
                            @if (Route::has('password.request'))
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
            </div>
        </div>
    </div>

            <div class="c-input__area c-input__area--another">
                <a class="" href="{{ route('register') }}"> 新規登録へ</a>
            </div>
        </section>
@endsection
