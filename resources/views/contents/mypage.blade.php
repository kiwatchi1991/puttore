@extends('layouts.app')

@section('content')
<div class="">
    <h2>{{ __('Drill List') }}</h2>
    <div class="">

        @foreach ($contents as $content)

        <div class="">
            <div class="">
                <div class="">
                    <h3 class="">{{ $content->title }}</h3>
                    {{-- <a href="#" class="btn btn-primary">{{ __('Go Practice')  }}</a> --}}
                    <a href="{{ route('contents.edit',$content->id ) }}"
                        class="">{{ __('Go Practice')  }}</a>
                    <form action="{{ route('contents.delete',$content->id ) }}" method="post" class="">
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