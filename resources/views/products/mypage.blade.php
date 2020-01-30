@extends('layouts.app')

@section('content')
<div class="">
    <h2>{{ __('Drill List') }}</h2>
    <div class="">

        @foreach ($products as $product)

        <div class="">
            <div class="">
                <div class="">
                    <h3 class="">{{ $product->title }}</h3>
                    {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                    <a href="{{ route('products.edit',$product->id ) }}"
                        class="">{{ __('Go Practice')  }}</a>
                    <form action="{{ route('products.delete',$product->id ) }}" method="post" class="">
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