@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__account">
    <div class="c-mypage__account__inner">

        <div class="c-mypage__title">
            <h2>振込用口座情報の登録</h2>
        </div>

        <form method="POST" action="{{ route('mypage.update', $id)}}" id="form-bankInfo">
            @csrf
            <div class="c-mypage__title c-mypage__title--bank">
                <p>下記は売上金の振込のため<br>必要な項目です</p>
            </div>

            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">銀行コード<span class="required">必須</span></p>
                <input id="bank_code" type="num" class="c-mypage__input-area @error('bank_code')is-invalid @enderror"
                    name="bank_code" value="{{ $bank->bank_code }}" autocomplete="bank_code"
                    placeholder="4桁のコードを入力してください" required>

                @error('bank_code')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">支店コード<span class="required">必須</span></p>
                <input id="bank_branch_code" type="num"
                    class="c-mypage__input-area @error('bank_branch_code')is-invalid @enderror" name="bank_branch_code"
                    value="{{ $bank->bank_branch_code }}" autocomplete="bank_branch_code" placeholder="3桁のコードを入力してください"
                    required>

                @error('bank_branch_code')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座名義人（カタカナ）<span class="required">必須</span></p>
                <input id="bank_account_holder_name" type="text"
                    class="c-mypage__input-area @error('bank_account_holder_name')is-invalid @enderror"
                    name="bank_account_holder_name" value="{{ $bank->bank_account_holder_name }}"
                    autocomplete="bank_account_holder_name" placeholder="" required>

                @error('bank_account_holder_name')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座種別<span class="required">必須</span></p>
                <div class="c-mypage__accountType">
                    <input type="radio" class="c-mypage__radio" name="bank_account_type" id="bank_account_type[0]"
                        value="0" checked="{{ $bank->bank_account_type === '0' }}">
                    <label for="bank_account_type[0]" class="c-mypage__radioLabel">
                        普通
                    </label>
                    <input type="radio" class="c-mypage__radio" name="bank_account_type" id="bank_account_type[1]"
                        value="1" checked="{{ $bank->bank_account_type === '1' }}">
                    <label for="bank_account_type[1]" class="c-mypage__radioLabel">
                        当座
                    </label>
                </div>

                @error('bank_account_type')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座番号<span class="required">必須</span></p>
                <input id="bank_account_number" type="number"
                    class="c-mypage__input-area @error('bank_account_number')is-invalid @enderror"
                    name="bank_account_number" value="{{ $bank->bank_account_number }}"
                    autocomplete="bank_account_number" placeholder="" required>

                @error('bank_account_number')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__agree">「銀行情報を登録する」ボタンを押すことにより、<a class="c-mypage__agree__link"
                        href="https://pay.jp/legal/tos-payouts" target="_blank">PAY.JP
                        Platform（Payouts）利用規約</a> に同意したものとします。</p>
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