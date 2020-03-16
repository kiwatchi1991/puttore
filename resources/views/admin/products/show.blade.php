@extends('layouts.admin')
@section('content')

{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
<div class="c-admin__title">プロダクト詳細画面</div>

<div class="admin__userEdit">
    <div class="c-admin__user__info">
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">id </div>
            <span>{{ $product->id }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">ユーザーid</div>
            <span>{{ $product->user_id }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">タイトル</div>
            <span>{{ $product->name }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">説明文
            </div>
            <span>{{ $product->detail }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">無料フラグ</div>
            <span>{{ $product->free_flg }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真１</div>
            <span>{{ $product->pic1 }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真2</div>
            <span>{{ $product->pic2 }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真3</div>
            <span>{{ $product->pic3 }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真4</div>
            <span>{{ $product->pic4 }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真5</div>
            <span>{{ $product->pic5 }}</span>
        </div>
        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">写真6</div>
            <span>{{ $product->pic6 }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">受講に必要なスキル</div>
            <span>{{ $product->skills }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">セールフラグ</div>
            <span>{{ $product->price_flg }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">定価</div>
            <span>{{ $product->default_price }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">公開フラグ</div>
            <span>{{ $product->open_flg }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">削除フラグ</div>
            <span>{{ $product->delete_flg }}</span>
        </div>



        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">作成日</div>
            <span>{{ $product->created_at }}</span>
        </div>

        <div class="c-admin__user__info__list">
            <div class="c-admin__user__data">更新日</div>
            <span>{{ $product->updated_at }}</span>
        </div>

    </div>
    <div class="c-admin__userEdit__btn">
        <a class="c-admin__btn" href="/admin/products">戻る</a>
    </div>
    @endsection
</div>