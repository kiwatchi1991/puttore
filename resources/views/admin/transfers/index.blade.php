@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        <p class="c-admin__sort__title">並べ替え</p>
        <div class="p-admin__sort__listWrap">
            {{-- <a class="c-admin__sort__list" href="{{ route('admin.transfer','sort=0')}}">id 降順▼</a> --}}
            {{-- <a class="c-admin__sort__list" href="{{ route('admin.transfer','sort=1')}}">id 昇順▲</a> --}}
        </div>
    </div>

    <div class="c-admin__search">
        {{-- <form class="" method="post" action="{{ route('admin.transfer.search') }}"> --}}
        @csrf
        <div class="c-admin__search__wrap">
            <input class="c-admin__input" type="text" name="keyword" value="" placeholder="メールアドレスで検索">
            <input class="c-admin__search__btn" type="submit" value="検索">
        </div>
        </form>
    </div>

</div>

<div class="c-admin__delete">
    <form method="post" action="">
        @csrf
        <div class="c-admin__delete__btnWrap">
            <input class="c-admin__delete__btn" type="submit" value="選択した情報を削除">
        </div>
        <div class="c-admin__title">振込依頼一覧</div>

        <div class="admin__users">
            <div class="c-admin__users">
                @foreach ($transfers as $transfer)
                <div class="c-admin__user__list">
                    <input type="checkbox" name="update_id[][0]" value="{{ $transfer->id }}" class="c-admin__checkbox">
                    <div class="c-admin__user__element id">id <span>{{$transfer->id}}</span></div>
                    <div class="c-admin__user__element email">メールアドレス<span>@php echo mb_strimwidth($transfer->email, 0,
                            15,
                            "...");@endphp</span></div>
                    <div class="c-admin__user__element id">
                        振込金額<span>{{ number_format($transfer->transfer_price) }}</span></div>
                    <div class="c-admin__user__element id">支払期日<span>{{$transfer->payment_date}}</span></div>
                    <a class="c-admin__user__edit" href="">確認</a>
                    <a class="c-admin__user__delete"
                        href="{{ route('admin.transfer.update.confirm',$transfer->id)}}">振込完了</a>
                </div>
                @endforeach
            </div>
            {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        </div>
    </form>
</div>
@endsection