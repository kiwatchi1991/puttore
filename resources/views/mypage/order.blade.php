@extends('layouts.app')
@section('title','マイページ')
@section('content')

<div class="c-mypage__nav">
    <div class="c-mypage__nav__list"><a href="/mypage">作品一覧<br>（下書き / 購入 / 販売）</a></div>
    <div class="c-mypage__nav__listactive"><a href="/mypage/order">販売管理</a></div>
</div>


<div class="c-mypage__order">
    <div class="c-mypage__sale">
        <div class="c-profile__title__product">
            <h2>販売履歴</h2>
        </div>
        {{-- @if($drafts->count() == 0) --}}
        <div class="c-profile__title__product">
            <p>今月の売上</p>
        </div>
        {{-- @endif --}}
        <div class="c-mypage__sale__thisMonth">
            <div class="c-mypage__sale__thisMonth__total">総額</div>
            <div class="c-mypage__sale__thisMonth__price">¥ 1,000</div>
            <div class="c-mypage__sale__thisMonth__detail"><a href="">詳細</a></div>
        </div>

        <div class="c-profile__title__product">
            <p style="margin-top: 32px">未振込の売上</p>
        </div>
        <div class="c-mypage__sale__untransferred__wrapper">
            <div class="c-mypage__sale__untransferred">
                <div class="c-mypage__sale__untransferred__total">総額</div>
                <div class="c-mypage__sale__untransferred__price">¥ 1,000</div>
                <div class="c-mypage__sale__untransferred__empty"></div>
            </div>
            　　 <p class="c-mypage__sale__untransferred__text">
                前月末時点での未振込の売上金総額が1,000円以下の場合は振込を翌月に繰越します。</p>　
        </div>
        <div class="c-profile__title__product">
            <p style="margin-top: 32px">処理済みの売上</p>
        </div>

        <div class="c-mypage__sale__done">
            <table>
                <thead>
                    <tr>
                        <th>期間</th>
                        <th>売上</th>
                        <th>状況</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2019年3月</td>
                        <td>¥ 2000</td>
                        <td>振込済</td>
                        <td>詳細</td>
                    </tr>
                    <tr>
                        <td>2019年3月</td>
                        <td>¥ 2000</td>
                        <td>振込済</td>
                        <td>詳細</td>
                    </tr>
                    <tr>
                        <td>2019年3月</td>
                        <td>¥ 2000</td>
                        <td>振込済</td>
                        <td>詳細</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>






<div class="c-profile__title__product">
    <h2>購入履歴</h2>
    {{-- @if($drafts->count() == 0) --}}
    <p style="margin-top: 32px">現在ありません</p>
    {{-- @endif --}}
</div>













@endsection