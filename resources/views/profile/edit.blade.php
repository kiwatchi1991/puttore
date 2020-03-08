@extends('layouts.app')

@section('content')

    <div class="c-profileEdit">
    <div class="c-profileEdit__title">プロフィールを編集する</div>

        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf

            {{-- 画像 --}}
            <div class="c-profileEdit__area">
                    <div class="c-image__preview">
                        <label class="js-area__drop">
                            <input class="c-input__file" type="file" name="pic" >
                            <img src="/storage/{{ $user->pic }}" alt=""  class="c-prev__img">
                            ドラッグ＆ドロップ
                        </label>
                        {{-- 画像削除 --}}
                        <p class="c-delete__file">消す</p>
                    </div>

                    @error('pic')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            {{-- アカウント名 --}}
            <div class="c-input__area">
                <label for="account_name"
                    >アカウント名</label>

                <div>
                    <input id="account_name" type="text"
                    class="c-input__form @error('account_id') is-invalid @enderror" name="account_name"
                        required autocomplete="account_name" value="{{ $user->account_name }}">

                    @error('account_name')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            {{-- 肩書き --}}
            <div class="c-input__area">
                <label for="account_title"
                    >肩書き</label>

                <div>
                    <input id="account_title" type="text"
                    class="c-input__form @error('account_id') is-invalid @enderror" name="account_title"
                        required autocomplete="account_title" value="{{ $user->account_title }}">

                    @error('account_title')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            {{-- 自己紹介 --}}
            <div class="c-input__area">
                <label for="account_detail"
                    >自己紹介</label>

                <div>
                    <input id="account_detail" type="text"
                    class="c-input__form @error('account_id') is-invalid @enderror" name="account_detail"
                        required autocomplete="account_detail" value="{{ $user->account_detail }}">

                    @error('account_detail')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            {{-- 保存ボタン --}}
            <div class="c-button__block">
                <button type="submit" class="c-button">
                   登録する
                </button>
            </div>
        </form>

    </div>

@endsection