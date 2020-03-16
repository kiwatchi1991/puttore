@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        並べ替え
        <a class="c-admin__sort__list" href="{{ route('admin.product','sort=0')}}">id 降順</a>
        <a class="c-admin__sort__list" href="{{ route('admin.product','sort=1')}}">id 昇順</a>
    </div>

    <div class="c-admin__search">
        <form class="" method="post" action="{{ route('admin.product.search') }}">
            @csrf
            <div class="">
                <input class="c-admin__input" type="text" name="keyword" value="" placeholder="メールアドレスで検索">
                <input class="c-admin__search__btn" type="submit" value="検索">
            </div>
        </form>
    </div>

</div>

<div class="c-admin__delete">
    <form method="POST" action="">
        @csrf
        <input class="c-admin__delete__btn" type="submit" value="一括削除">

        <div class="c-admin__title">プロダクト一覧</div>

        <div class="admin__users">
            <div class="c-admin__users">
                @foreach ($products as $product)
                <div class="c-admin__user__list">
                    <input type="checkbox" name="delete_id[][0]" value="{{ $product->id }}">
                    <div class="c-admin__user__element id">id <span>{{$product->id}}</span></div>
                    <div class="c-admin__user__element email">ユーザーメールアドレス<span>@php echo mb_strimwidth($product->email,
                            0,
                            15,
                            "...");@endphp</span></div>
                    <div class="c-admin__user__element">ユーザーid<span>{{ $product->user_id }}</span></div>
                    <div class="c-admin__user__element name">タイトル<span>{{ $product->name }}</span></div>
                    <a class="c-admin__user__edit" href="/admin/products/{{ $product->id }}">確認</a>
                    <a class="c-admin__user__delete"
                        href="{{ route('admin.product.delete.confirm',$product->id)}}">削除</a>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection