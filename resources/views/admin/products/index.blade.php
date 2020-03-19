@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        <p class="c-admin__sort__title">並べ替え</p>
        <div class="p-admin__sort__listWrap">
        <a class="c-admin__sort__list" href="{{ route('admin.product','sort=0')}}">id 降順 ▼</a>
        <a class="c-admin__sort__list" href="{{ route('admin.product','sort=1')}}">id 昇順 ▲</a>
        </div>
    </div>

    <div class="c-admin__search">
        <form class="" method="post" action="{{ route('admin.product.search') }}">
            @csrf
            <div class="c-admin__search__wrap">
                <input class="c-admin__input" type="text" name="keyword" value="" placeholder="メールアドレスで検索">
                <input class="c-admin__search__btn" type="submit" value="検索">
            </div>
        </form>
    </div>

</div>

<div class="c-admin__delete">
    {{-- <form method="POST" action="/admin/products/delete/{{ delete_id[]}}"> --}}
    <form method="POST" action="{{route('admin.product.delete.confirm','delete_id[]')}}">
        @csrf
        <div class="c-admin__delete__btnWrap">
          <input class="c-admin__delete__btn" type="submit" value="一括削除">
        </div>
        <div class="c-admin__title">プロダクト一覧</div>

        <div class="admin__users">
            <div class="c-admin__users">
                @foreach ($products as $product)
                <div class="c-admin__user__list">
                    <input type="checkbox" name="delete_id[][0]" value="{{ $product->id }}" class="c-admin__checkbox">
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
