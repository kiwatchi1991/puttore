@extends('layouts.admin')
@section('content')

<div class="c-admin__title">振込依頼確認画面</div>

<div class="admin__userEdit">
    <div class="c-admin__user__info">
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">id </div>
            <span>{{ $transfer->id }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">依頼ユーザーid</div>
            <span>{{ $transfer->{'u.id'} }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">依頼ユーザー名</div>
            <span>{{ $transfer->account_name }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">依頼ユーザーメールアドレス</div>
            <span>{{ $transfer->email }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">振込金額</div>
            <span>¥ {{ number_format($transfer->transfer_price) }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">ユーザーが振込依頼を実施した日</div>
            <span>{{ $transfer->created_at }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">支払い期日</div>
            <span>{{ $transfer->payment_date }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">振込元銀行</div>
            <span>{{ $transfer->bank_name }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">手数料</div>
            <span>¥ {{ number_format($transfer->commission) }}</span>
        </div>

    </div>
    <div class="c-admin__userEdit__btn">
        <a class="c-admin__btn" href="{{route('admin.transfer')}}">戻る</a>
    </div>
    @endsection
</div>