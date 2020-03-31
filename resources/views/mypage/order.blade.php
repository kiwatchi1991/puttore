@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">アカウント</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/like">お気に入り</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/draft">下書き</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/buy">購入作品</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/sale">出品作品</a></a></div>
    <div class="c-mypage__nav__list active"><a href="/mypage/order">販売管理</a></div>
    <div class="c-mypage__nav__list"><a href="/mypage/paid">振込履歴</a></div>
</div>

<div class="c-mypage__order">
    <div class="c-mypage__sale">
        <div class="c-mypage__products__title c-mypage__products__title--sale">
            <h2>販売管理</h2>
        </div>

        <div class="c-mypage__sale__thisMonth">
            <div class="c-mypage__sale__thisMonth__title">
                <p>今月の売上</p>
            </div>
            <div class="c-mypage__sale__thisMonth__price__wrapper">

                <div class="c-mypage__sale__thisMonth__total">総額</div>
                @foreach($thisMonth as $mon => $price)
                <div class="c-mypage__sale__thisMonth__price"><span class="c-mypage__sale__icon">¥</span>
                    {{ number_format($price) }}
                </div>
                @endforeach
                {{-- 金額が0円の場合はDOMが表示されなくなるので、これを表示 --}}
                @if ($thisMonth->count()==0)
                <div class="c-mypage__sale__thisMonth__price"><span class="c-mypage__sale__icon">¥</span> 0</div>
                @endif
            </div>
            @foreach($thisMonth as $mon => $price)
            <div class="c-mypage__sale__thisMonth__detail"><a
                    href="{{ route('mypage.order.show',($mon)?$mon:'') }}">詳細</a></div>
            @endforeach
        </div>

        {{-- 未振込の計上 --}}
        <div class="c-mypage__sale__untransferred">
            <div class="c-mypage__sale__untransferred__title">
                <p>未振込の売上</p>
            </div>
            <div class="c-mypage__sale__untransferred__price__wrapper">
                <div class="c-mypage__sale__untransferred__total">総額</div>

                @foreach($untransferred_price as $mon => $price)
                <div class="c-mypage__sale__untransferred__price"><span class="c-mypage__sale__icon">¥</span>
                    {{ number_format($price) }}
                </div>
                @endforeach
                {{-- 金額が0円の場合はDOMが表示されなくなるので、これを表示 --}}
                @if ($untransferred_price->count()==0)
                <div class="c-mypage__sale__untransferred__price"><span class="c-mypage__sale__icon">¥</span> 0</div>
                @endif

                <div class="c-mypage__sale__untransferred__request js-request-transfer">

                    {{-- 5000円以下の場合は表示しない --}}
                    @foreach($untransferred_price as $mon => $price)
                    @if ($price > 5000)
                    <a href="/mypage/transfer" class="c-mypage__sale__untransferred__request__link">振込依頼</a>
                    @endif
                    @endforeach

                </div>
            </div>
            <p class="c-mypage__sale__untransferred__text">
                前月末時点での未振込の売上金総額が5,000円以上になると、振込依頼ができるようになります。</p>　
        </div>

        {{-- 処理済みの計上 --}}

        <div class="c-mypage__sale__done">
            <div class="c-mypage__sale__done__title">
                <p>処理済みの売上</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="c-mypage__sale__list c-mypage__sale__list--day">振込依頼日</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--price">振込金額</th>
                        <th class="c-mypage__sale__list c-mypage__sale__list--status">状況</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->created_at->format('Y年m月d日') }}</td>
                        <td>¥ {{ number_format($transfer->transfer_price) }}</td>
                        <td><a href="{{ route('mypage.order.transfer.show',$transfer->id) }}">@if($transfer->status == 0)申請中@else 振込済 @endif</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- 金額が0円の場合はDOMが表示されなくなるので、これを表示 --}}
            @if ($transfers->count()==0)
            <div class="c-mypage__sale__list__text">※処理済みの売上はありません。</div>
            @endif
        </div>

    </div>
</div>
@endsection
