@extends('layouts.app')
@section('title','お問い合わせ')
@section('content')
<div class="c-contact">
    <div class="c-contact__inner">
        <h2 class="c-contact__title">お問い合わせ内容確認</h2>
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="c-contact__prev-area c-contact__prev-area__mail">
                <label class="c-contact__label--confirm">メールアドレス</label>
                <div class="c-contact__prev">
                    {{ $inputs['email'] }}
                </div>
                <input name="email" value="{{ $inputs['email'] }}" type="hidden">
            </div>

            <div class="c-contact__prev-area c-contact__prev-area__mail">
                <label class="c-contact__label--confirm">タイトル</label>
                <div class="c-contact__prev">
                    {{ $inputs['title'] }}
                </div>
                <input name="title" value="{{ $inputs['title'] }}" type="hidden">
            </div>


            <div class="c-contact__prev-area c-contact__prev-area__mail">
                <label class="c-contact__label--confirm">お問い合わせ内容</label>
                <div class="c-contact__prev">
                    {!! nl2br(e($inputs['body'])) !!}
                </div>
                <input name="body" value="{{ $inputs['body'] }}" type="hidden">
            </div>

            <button type="submit" name="action" value="back" class="c-contact__submit">
                入力内容修正
            </button>
            <button type="submit" name="action" value="submit" class="c-contact__submit c-contact__submit--post">
                送信する
            </button>
        </form>
    </div>
</div>
@endsection