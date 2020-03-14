@extends('layouts.app')
@section('title','お問い合わせ')
@section('content')
<div class="c-contact">
    <div class="c-contact__inner">
        <h2 class="c-contact__title">お問い合わせ</h2>
        <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf
            <div class="c-contact__inputArea">

                <div class="c-contact__input-area c-contact__input-area__mail">

                    <label class="c-contact__label">メールアドレス</label>
                    <div>
                        <input class="c-contact__input" name="email" value="{{ old('email') }}" type="email">
                    </div>
                    @if ($errors->has('email'))
                    <p class="c-contact__error">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="c-contact__input-area c-contact__input-area__sub">

                    <label class="c-contact__label">タイトル</label>
                    <div class="">
                        <input class="c-contact__input" name="title" value="{{ old('title') }}" type="text">
                    </div>
                    @if ($errors->has('title'))
                    <p class="c-contact__error">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="c-contact__input-area c-contact__input-area__main">

                    <label class="c-contact__label">お問い合わせ内容</label>
                    <div class="">
                        <textarea class="c-contact__input" name="body" rows="10">{{ old('body') }}</textarea>
                    </div>
                    @if ($errors->has('body'))
                    <p class="c-contact__error">{{ $errors->first('body') }}</p>
                    @endif

                </div>
                <button type="submit" class="c-contact__submit">
                    入力内容確認
                </button>
            </div>
        </form>
    </div>
</div>
@endsection