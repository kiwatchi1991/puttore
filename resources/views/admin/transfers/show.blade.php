@extends('layouts.admin')
@section('content')

<div class="c-admin__title">振込依頼確認画面</div>

<div class="admin__userEdit">
    <form method="POST" action="{{ route('admin.user.update',$user->id) }}">
        @csrf
        <div class="c-admin__user__info">
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">id </div>
                <span class="c-admin__user__info__item">{{ $user->id }}</span>
            </div>
            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">group（0：一般ユーザー　１：管理者）</div>
                <span><input class="c-admin__input" type="text" name="group" id="" value="{{ $user->group }}"></span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">名前</div>
                <span class="c-admin__user__info__item>{{ $user->account_name }}</span>
            </div>

            <div class=" c-admin__user__info__list">
                    <div class="c-admin__user__data">肩書き</div>
                    <span>{{ $user->title }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">自己紹介</div>
                <span>{{ $user->detail }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">メールアドレス</div>
                <span>{{ $user->email }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">作成日</div>
                <span>{{ $user->created_at }}</span>
            </div>

            <div class="c-admin__user__info__list">
                <div class="c-admin__user__data">更新日</div>
                <span>{{ $user->updated_at }}</span>
            </div>

        </div>
        <div class="c-admin__userEdit__btn">
            <button type="submit" class="c-admin__btn">編集内容を保存する</button>
        </div>
    </form>
    @endsection
</div>