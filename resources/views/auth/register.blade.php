@extends('layouts.app')

@section('content')

            <section class="register">
                <div class="l-auth__inner">
                <div class="c-pageTitle">新規登録</div>

                    <form method="POST" class="l-auth__formArea" action="{{ route('register') }}">
                        @csrf

                        <div class="c-input__area">
                            <label for="account_id"
                                >id</label>

                            <div>
                                <input id="account_id" class="c-input__form @error('account_id') is-invalid @enderror" type="text"
                                     name="account_id"
                                    value="{{ old('account_id') }}" required autocomplete="account_id" autofocus>

                                @error('account_id')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="c-input__area">
                            <label for="account_name"
                                >ニックネーム</label>

                            <div>
                                <input id="account_name" class="c-input__form @error('account_id') is-invalid @enderror" type="text" name="account_name"
                                    value="{{ old('account_name') }}" required autocomplete="account_name" autofocus>

                                @error('account_name')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="c-input__area">
                            <label for="email"
                                >メールアドレス</label>

                            <div>
                                <input id="email" type="email" class="register__input-area" @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="c-input__area">
                            <label for="password"
                                >パスワード</label>

                            <div>
                                <input id="password" type="password"
                                class="c-input__form @error('account_id') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="c-input__area">
                            <label for="password-confirm"
                                >パスワード確認</label>

                            <div >
                                <input id="password-confirm" type="password" class="c-input__form @error('account_id') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                            <div class="c-button__block">
                                <button type="submit" class="c-button">
                                   登録する
                                </button>
                            </div>
                    </form>

                </div>
                <div class="c-input__area c-input__area--another">
                    <a class="" href="{{ route('login') }}">ログインへ</a>
                </div>

            </section>
@endsection