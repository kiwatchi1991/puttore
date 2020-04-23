@extends('layouts.app')
@section('title','パスワードリセット')

@section('content')
<div class="c-passReset__inner">
    <div class="c-passReset__inner__head">
        <h2 class="c-passReset__title">パスワードをリセットする</h2>
    </div>
    <div class="c-passReset__form-area">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="c-passReset__input-area">
                <label for="email" class="c-passReset__input-label">メールアドレス</label>

                <div class="">
                    <input id="email" type="email" class="c-passReset__input @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="c-passReset__input-area">
                <label for="password" class="c-passReset__input-label">パスワード</label>

                <div class="">
                    <input id="password" type="password"
                        class="c-passReset__input @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="c-passReset__input-area">
                <label for="password-confirm" class="c-passReset__input-label">パスワード確認</label>

                <div class="">
                    <input id="password-confirm" type="password" class="c-passReset__input" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>

            <div class="c-passReset__button">
                <button type="submit" class="c-passReset__btn">
                    パスワードをリセットする
                </button>
            </div>
        </form>
    </div>
</div>
@endsection