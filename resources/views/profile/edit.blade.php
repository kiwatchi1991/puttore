@extends('layouts.app')
@section('title','プロフィール編集')
@section('content')

<div class="c-profileEdit">
    <div class="c-profileEdit__title">プロフィールを編集する</div>
    <div class="c-profileEdit__inner">
        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf

            {{-- 画像 --}}
            <div class="c-profileEdit__img-area">
                <div class="c-profileEdit__img">
                    <label class="c-profileEdit__img__label js-area__drop">
                        <img src="/storage/{{ $user->pic }}" alt="" id="js-profile__img"
                            class="c-profileEdit__img__img js-prev__img">

                        <!-- 切り抜き範囲をhiddenで保持する -->
                        <input type="hidden" id="upload-image-x" name="profileImageX" value="0" />
                        <input type="hidden" id="upload-image-y" name="profileImageY" value="0" />
                        <input type="hidden" id="upload-image-w" name="profileImageW" value="0" />
                        <input type="hidden" id="upload-image-h" name="profileImageH" value="0" />

                    </label>
                </div>
                <label for="img" class="c-profileEdit__img__text">
                    <input class="c-profileEdit__img__input js-input__file--profile" type="file" name="pic" id="img">
                    画像を変更する
                </label>
                {{-- 画像削除 --}}
                {{-- <p class="js-delete__file">消す</p> --}}

                @error('pic')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="c-profileEdit__input-area">
                {{-- アカウント名 --}}
                <label for="account_name" class="c-profileEdit__input-label">アカウント名</label>

                <div>
                    <input id="account_name" type="text"
                        class="c-profileEdit__input @error('account_id') is-invalid @enderror" name="account_name"
                        required autocomplete="account_name" value="{{ $user->account_name }}">

                    @error('account_name')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{-- 肩書き --}}
                <div class="c-profileEdit__input-area">
                    <label for="account_title" class="c-profileEdit__input-label">肩書き</label>

                    <div>
                        <input id="account_title" type="text"
                            class="c-profileEdit__input @error('account_id') is-invalid @enderror" name="account_title"
                            required autocomplete="account_title" value="{{ $user->account_title }}">

                        @error('account_title')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- 自己紹介 --}}
                <div class="c-profileEdit__input-area">
                    <label for="account_detail" class="c-profileEdit__input-label">自己紹介</label>

                    <div>
                        <input id="account_detail" type="text"
                            class="c-profileEdit__input @error('account_id') is-invalid @enderror" name="account_detail"
                            required autocomplete="account_detail" value="{{ $user->account_detail }}">

                        @error('account_detail')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- 保存ボタン --}}
                <div class="c-profileEdit__submit">
                    <button type="submit" class="c-profileEdit__submit__button">
                        登録する
                    </button>
                </div>
        </form>
    </div>
</div>

@endsection