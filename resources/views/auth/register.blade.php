@extends('layouts.app')
@section('title','新規登録')
@section('content')

<div class="c-register__inner">
  <div class="c-register__inner__head">
    <p class="c-register__title">新規登録</p>
    <p class="c-register__title--under">REGISTRATION</p>
  </div>
  <div class="c-register__form-area">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="c-register__input-area">
        <label for="email" class="c-register__input-label">メールアドレス</label>

        <div>
          <input id="email" type="email" class="c-register__input @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">

          @error('email')
          <span class="error">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="c-register__input-area">
        <label for="password" class="c-register__input-label">パスワード</label>
        <div>
          <input id="password" type="password" class="c-register__input @error('account_id') is-invalid @enderror"
            name="password" required autocomplete="new-password">

          @error('password')
          <span class="error" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="c-register__input-area">
        <label for="password-confirm" class="c-register__input-label">パスワード確認</label>
        <div>
          <input id="password-confirm" type="password"
            class="c-register__input @error('account_id') is-invalid @enderror" name="password_confirmation" required
            autocomplete="new-password">
        </div>
      </div>

      <div class="c-register__button">
        <button type="submit" class="c-register__btn">
          登録する
        </button>
      </div>
    </form>
  </div>

  <div class="c-register__to-login">
    <a class="" href="{{ route('login') }}">ログインへ</a>
  </div>
</div>

@endsection
