@extends('layouts.app')
@section('title','ログイン')
@section('content')

<div class="c-login__inner">
  <div class="c-login__inner__head">
    <p class="c-login__title">ログイン</p>
    <p class="c-login__title--under">LOG IN</p>
  </div>

  <div class="c-login__form-area">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="c-login__input-area">
        <label for="email" class="c-login__input-label">メールアドレス</label>

        <div class="">
          <input id="email" type="email" class="c-login__input @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
          <span class="error" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="c-login__input-area">
        <label for="password" class="c-login__input-label">パスワード</label>

        <div class="">
          <input id="password" type="password" class="c-login__input @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">

          @error('password')
          <span class="error" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="c-login__remember">
        <input type="checkbox" class="c-login__remember__checkbox" name="remember" id="remember"
          {{ old('remember') ? 'checked' : '' }}>
        <label class="c-login__remember__label" for="remember">

          ログインしたままにする</label>
      </div>

      @if (Route::has('password.request'))
      <div class="c-login__forget">
        パスワードを忘れた方は<a class="c-login__forget__link" href="{{ route('password.request') }}">こちら</a>
      </div>
      @endif


      <div class="c-login__button">
        <button type="submit" class="c-login__btn">
          ログイン
        </button>

      </div>
    </form>
  </div>
  <div class="c-login__to-register">
    <a class="" href="{{ route('register') }}"> 新規登録へ</a>
  </div>
</div>

@endsection
