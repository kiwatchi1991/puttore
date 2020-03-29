@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list active"><a href="/mypage">アカウント</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/like">お気に入り</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/draft">下書き</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/buy">購入作品</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/sale">出品作品</a></a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/order">販売管理</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/paid">振込履歴</a></div>
</div>
<div class="c-mypage__account">
    <div class="c-mypage__account__inner">

        <div class="c-mypage__title">
            <h2>振込用口座情報の登録</h2>
        </div>

        <form method="POST" action="{{ route('mypage.update', $id)}}">
            @csrf
            <div class="c-mypage__title c-mypage__title--bank">
                <p>下記は売上金の振込のため<br>必要な項目です</p>
            </div>

            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">銀行名 <span class="c-mypage__editLink"></span></p>
                <input id="bank_name" type="text" class="c-mypage__input-area @error('bank_name')is-invalid @enderror"
                    name="bank_name" value="{{ $bank->bank_name }}" autocomplete="bank_name" placeholder="" required>

                @error('bank_name')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">支店 <span class="c-mypage__editLink"></span></p>
                <input id="bank_branch" type="text"
                    class="c-mypage__input-area @error('bank_branch')is-invalid @enderror" name="bank_branch"
                    value="{{ $bank->bank_branch }}" autocomplete="bank_branch" placeholder="" required>

                @error('bank_branch')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座番号 <span class="c-mypage__editLink"></span></p>
                <input id="bank_account_num" type="number"
                    class="c-mypage__input-area @error('bank_account_num')is-invalid @enderror" name="bank_account_num"
                    value="{{ $bank->bank_account_num }}" autocomplete="bank_account_num" placeholder="" required>

                @error('bank_account_num')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="c-mypage__submit">
                <button type="submit" class="c-mypage__submit__button">
                    銀行情報を登録する
                </button>
            </div>
        </form>
    </div>
</div>




@endsection