@extends('layouts.app')

@section('content')
<div class="c-passReset">
    <h2 class="c-passReset__title">パスワードをリセットする</h2>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="c-passReset__prev-area c-passReset__prev-area__mail">
            <label for="email" class="c-passReset__label">メールアドレス</label>

            <div>
                <input class="c-passReset__input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required type="email">
            </div>
            @error('email')
            <span class="c-passReset__error" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="c-passReset__submit">
            パスワードリセットリンクを送信する
        </button>
    </form>
</div>
@endsection