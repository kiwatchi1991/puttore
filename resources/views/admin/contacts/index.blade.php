@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        <p class="c-admin__sort__title">並べ替え</p>
        <div class="p-admin__sort__listWrap">
          <a class="c-admin__sort__list" href="{{ route('admin.contact','sort=0')}}">id 降順 ▼</a>
          <a class="c-admin__sort__list" href="{{ route('admin.contact','sort=1')}}">id 昇順 ▲</a>
        </div>
    </div>

    <div class="c-admin__search">
        <form class="" method="post" action="{{ route('admin.contact.search') }}">
            @csrf
            <div class="c-admin__search__wrap c-admin__mb">
                <input class="c-admin__input" type="text" name="keyword" value="" placeholder="メールアドレスで検索">
                <input class="c-admin__search__btn" type="submit" value="検索">
            </div>
        </form>
    </div>
</div>

<div class="c-admin__delete">
    <div class="c-admin__title">お問い合わせ一覧</div>

    <div class="admin__users">
        <div class="c-admin__users">
            @foreach ($contacts as $contact)
            <div class="c-admin__user__list">
                <div class="c-admin__user__element id">id <span>{{ $contact->id}}</span></div>
                <div class="c-admin__user__element id">ユーザーid <span>{{ $contact->user_id }}</span></div>
                <div class="c-admin__user__element email">アドレス<span>{{ $contact->email }}</span></div>
                <div class="c-admin__user__element title">件名<span>{{$contact->title }}</span></div>
                <a class="c-admin__user__edit" href="{{ route('admin.contact.show',$contact->id)}}">確認</a>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
