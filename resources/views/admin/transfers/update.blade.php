@extends('layouts.admin')
@section('content')

{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
<div class="c-admin__title">振込実行完了　画面</div>

<div class="c-admin__confirm">以下の振込依頼情報のステータスを「振込完了」にしますか？</div>

<div class="admin__userEdit">
    {{-- <form method="POST" action="{{ route('admin.de.update') }}"> --}}
    <form method="POST" action="">
        @csrf
        @foreach($transfers as $transfer)
        <input type="hidden" name="update_id[]" value="{{ $transfer->id }}">
        <div class="c-admin__user__info">
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">id </div>
                <span>{{ $transfer->id }}</span>
            </div>
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">依頼ユーザーid</div>
                <span>{{ $transfer->group }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">依頼ユーザー名</div>
                <span>{{ $transfer->account_name }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">依頼ユーザーメールアドレス</div>
                <span>{{ $transfer->title }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">振込金額</div>
                <span>{{ $transfer->detail }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">手数料</div>
                <span>{{ $transfer->email }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">入金額（振込金額-手数料）</div>
                <span>{{ $transfer->created_at }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">振込元銀行</div>
                <span>{{ $transfer->updated_at }}</span>
            </div>
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">ユーザーが振込依頼を実施した日</div>
                <span>{{ $transfer->updated_at }}</span>
            </div>
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">支払い期日</div>
                <span>{{ $transfer->updated_at }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">振込元銀行</div>
                <span>{{ $transfer->updated_at }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">振込日</div>
                <span><input class="c-admin__input js-date_picker" type="text" name="payment_date[{{ $transfer->id }}]"
                        id="" value="" required></span>
            </div>

        </div>
        @endforeach
        <div class="c-admin__userEdit__btn">
            <button type="submit" class="c-admin__btn">削除する</button>
        </div>

    </form>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @endsection
</div>