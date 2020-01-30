@extends('layouts.app')

@section('content')
<div>
    <div>
        <div >
            <section class="register">
                <div class="register__wrapper">
                <div>新規登録</div>

                <div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <label for="account_id"
                                ="col-md-4 col-form-label text-md-right">{{ __('account_Id') }}</label>

                            <div>
                                <input id="account_id" class="register__input-area" type="text"
                                    ="form-control @error('account_id') is-invalid @enderror" name="account_id"
                                    value="{{ old('account_id') }}" required autocomplete="account_id" autofocus>

                                @error('account_id')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div >
                            <label for="account_name"
                                ="col-md-4 col-form-label text-md-right">{{ __('account_Name') }}</label>

                            <div>
                                <input id="account_name" class="register__input-area" type="text"
                                    ="form-control @error('account_name') is-invalid @enderror" name="account_name"
                                    value="{{ old('account_name') }}" required autocomplete="account_name" autofocus>

                                @error('account_name')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div >
                            <label for="email"
                                ="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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

                        <div>
                            <label for="password"
                                ="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password"
                                class="register__input-area @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password-confirm"
                                ="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div >
                                <input id="password-confirm" type="password" class="register__input-area"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div>
                            <div >
                                <button type="submit">
                                   登録する
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </section>
        </div>
    </div>
    <script src="/js/app.js"></script>
</div>
@endsection