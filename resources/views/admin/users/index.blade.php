@extends('layouts.admin')
@section('content')

<div class="c-admin__head">
    <div class="c-admin__sort">
        並べ替え
        <a class="c-admin__sort__list" href="{{ route('admin.user','sort=0')}}">id 降順</a>
        <a class="c-admin__sort__list" href="{{ route('admin.user','sort=1')}}">id 昇順</a>
    </div>

    <div class="c-admin__search">
        <form class="" method="post" action="{{ route('admin.user.search') }}">
            @csrf
            <div class="">
                <input class="c-admin__input" type="text" name="keyword" value="" placeholder="メールアドレスで検索">
                <input class="c-admin__search__btn" type="submit" value="検索">
            </div>
        </form>
    </div>

</div>

<div class="c-admin__delete">
    <form method="post" action="{{ route('admin.user.deletes.confirm','delete_id[]') }}">
        @csrf
        <input class="c-admin__delete__btn" type="submit" value="一括削除">

        <div class="c-admin__title">ユーザー一覧</div>

        <div class="admin__users">
            <div class="c-admin__users">
                @foreach ($users as $user)
                <div class="c-admin__user__list">
                    <input type="checkbox" name="delete_id[][0]" value="{{ $user->id }}">
                    <div class="c-admin__user__element id">id <span>{{$user->id}}</span></div>
                    <div class="c-admin__user__element email">メールアドレス<span>@php echo mb_strimwidth($user->email, 0, 15,
                            "...");@endphp</span></div>
                    <a class="c-admin__user__edit" href="{{ route('admin.user.edit',$user->id)}}">編集</a>
                    <a class="c-admin__user__delete" href="{{ route('admin.user.delete.confirm',$user->id)}}">削除</a>
                </div>
                @endforeach
            </div>
            {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        </div>
    </form>
</div>
@endsection