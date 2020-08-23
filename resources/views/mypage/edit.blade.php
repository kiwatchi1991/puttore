@extends('layouts.app')
@section('title','マイページ')
@section('content')

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
                <p class="c-mypage__account__label">銀行コード <span class="c-mypage__editLink"></span></p>
                <input id="bank_code" type="num" class="c-mypage__input-area @error('bank_code')is-invalid @enderror"
                    name="bank_code" value="{{ $bank->bank_code }}" autocomplete="bank_code" placeholder="" required>

                @error('bank_code')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">支店コード <span class="c-mypage__editLink"></span></p>
                <input id="bank_branch_code" type="num"
                    class="c-mypage__input-area @error('bank_branch_code')is-invalid @enderror" name="bank_branch_code"
                    value="{{ $bank->bank_branch_code }}" autocomplete="bank_branch_code" placeholder="" required>

                @error('bank_branch_code')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座名義人（カタカナ） <span class="c-mypage__editLink"></span></p>
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
                <p class="c-mypage__account__label">口座種別 <span class="c-mypage__editLink"></span></p>
                <select name="bank_account_type" id="bank_account_type">
                    <option value="">選択してください</option>
                    <option value="0" selected>普通</option>
                    <option value="1">当座</option>
                </select>
                {{-- <input id="bank_account_type" type="number"
                    class="c-mypage__input-area @error('bank_account_type')is-invalid @enderror" name="bank_account_type"
                    value="{{ $bank->bank_account_type }}" autocomplete="bank_account_type"
                placeholder="" required> --}}
                @error('bank_account_type')
                <span class="c-mypage__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="c-mypage__account__list">
                <p class="c-mypage__account__label">口座番号 <span class="c-mypage__editLink"></span></p>
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

            <div class="c-mypage__submit">
                <button type="submit" class="c-mypage__submit__button">
                    銀行情報を登録する
                </button>
            </div>
        </form>
    </div>
</div>




@endsection