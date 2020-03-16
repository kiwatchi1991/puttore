@extends('layouts.admin')
@section('content')

<div class="c-admin__title">注文詳細画面</div>

<div class="admin__userEdit">
    <div class="c-admin__user__info">
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">id </div>
            <span>{{ $contact->id }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">ユーザーid</div>
            <span>{{ $contact->user_id }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">メールアドレス</div>
            <span>{{ $contact->email }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">件名
            </div>
            <span>{{ $contact->title }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">本文</div>
            <span>{{ $contact->body }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">削除フラグ</div>
            <span>{{ $contact->delete_flg }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">お問い合わせ日時</div>
            <span>{{ $contact->created_at }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">更新日</div>
            <span>{{ $contact->updated_at }}</span>
        </div>

    </div>
    <div class="c-admin__userEdit__btn">
        <a class="c-admin__btn" href="/admin/contacts">戻る</a>
    </div>
    @endsection
</div>