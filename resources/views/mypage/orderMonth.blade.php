@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">作品一覧<br>（下書き / 購入 / 販売）</a></div>
    <div class="c-mypage__nav__listactive"><a href="/mypage/order">販売管理</a></div>
</div>



{{-- @if($sale_history->status == 0)
    未振込はこっち
    {{ $sale_history }}

@endif --}}

<div class="c-mypage__order">
    <div class="c-mypage__sale">
        <div class="c-profile__title__product">
            <h2>{{ $year_month }} の売上</h2>
        </div>

        <div class="c-mypage__sale__month">
            <table>
                <thead>
                    <tr>
                        <th class="c-mypage__sale__list c-mypage__sale__list--day">購入日</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--title">タイトル</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--price">価格</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td class="c-mypage__sale__list c-mypage__sale__list--day">
                            {{$sale->created_at->format('Y年m月d日')}}</td>
                        <td class="c-mypage__sale__list c-mypage__sale__list--title">{{$sale->name}}</td>
                        <td class="c-mypage__sale__list c-mypage__sale__list--price">¥
                            {{number_format($sale->sale_price)}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="c-mypage__sale__nothing">
                @if ($sales->count() == 0)
                ありません
                @endif
            </div>
        </div>

    </div>
</div>


@endsection