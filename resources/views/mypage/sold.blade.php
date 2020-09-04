@extends('layouts.app')
@section('title','マイページ')
@section('content')

@include('mypage.nav', ['page' => 'sold'])

@yield('header')
<div class="c-mypage__order">
    <div class="c-mypage__sale">
        <div class="c-mypage__products__title c-mypage__products--paid">
            <h2>売上履歴</h2>
        </div>

        <div class="c-mypage__sold__list">
            @foreach ($sold_data as $data)
            <div class="c-mypage__sold__item">
                <div class="c-mypage__sold__left">
                    <div class="c-mypage__sold__username"><a
                            href="{{ route('profile.show',$data->u_id) }}">{{ $data->account_name }}</a></div>
                    <div class="c-mypage__sold__productname"><a
                            href="{{ route('products.show',$data->p_id) }}">{{ $data->name }}</a></div>
                    <div class="c-mypage__sold__created">{{ $data->created_at->format('Y年m月d日') }}</div>
                </div>
                <div class="c-mypage__sold__right">
                    <div class="c-mypage__sold__price">¥ {{ number_format($data->sale_price) }}</div>
                </div>
            </div>
            @endforeach

            <div class="c-mypage__sale__nothing">
                @if ($sold_data->count() == 0)
                現在ありません
                @endif
            </div>
        </div>

        <div class="c-pagination">
            {{ $sold_data->appends(request()->input())->links('vendor.pagination.simple-default') }}
        </div>

    </div>
</div>


@endsection