@extends('layouts.app')

@section('content')
<div class="">
    <h2>{{ __('Drill List') }}</h2>
    <div class="">

        @foreach ($products as $product)
       プロダクトID {{ $product->id }}
        {{-- @foreach ($products_categories as $product_category) --}}
        

        <div class="">
            <div class="">
                <div class="">
                    <h3 class="">{{ $product->title }}</h3>
                    {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                    <a href="{{ route('products.edit',$product->id ) }}"
                        class="">{{ __('Go Practice')  }}</a>
                    <div>
                        
                        {{-- 言語表示 --}}
                        @foreach ($product_categories->find($product->id)->categories as $category)

                    <p>{{ $category->name }}</p>
                        @endforeach 
                        
                        {{-- 難易度表示 --}}
                        @foreach ($product_difficulties->find($product->id)->difficulties as $difficulty)
                        
                        <p>{{ $difficulty->name }}</p>

                        @endforeach
                    </div>
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