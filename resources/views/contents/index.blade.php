@extends('layouts.app')

@section('content')
<div class="">
    <h2>作品一覧</h2>
    <div class="">

        @foreach ($view_products as $product)

        <div class="">
            <div class="">
                <div class="">
                    <h3 class="">{{ $product->title }}</h3>
                    {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                    <a href="{{ route('contents.edit',$content->id ) }}"
                        class="">{{ __('Go Practice')  }}</a>
                    <form action="{{ route('contents.delete',$content->id ) }}" method="post" class="d-inline">
                        @csrf
                        <button class=""
                            onclick='return confirm("削除しますか？");'>{{ __('Go Delete')  }}</button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>
@endsection