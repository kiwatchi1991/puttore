@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <div class="">レッスン内容登録</div>

                <div class="">
                    <form method="POST" action="{{ route('contents.create') }}">
                        @csrf
                        {{-- 名前 --}}
                        <div class="">
                            <label for="name" class="">名前</label>

                            <div class="">
                                <input id="name" type="text" class=" @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- 説明 --}}
                        <div class="">
                            <label for="detail"
                                class="">説明</label>

                            <div class="">
                                <input id="detail" type="text"
                                    class=" @error('detail') is-invalid @enderror" name="detail"
                                    value="{{ old('detail') }}" autocomplete="detail" autofocus>

                                @error('detail')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- レッスン内容 --}}
                        <div class="">
                            <label for="lesson" class="">レッスン内容</label>

                            <div class="">
                                <input id="lesson" type="text" class=" @error('lesson') is-invalid @enderror"
                                    name="lesson" value="{{ old('lesson') }}" autocomplete="lesson" autofocus>

                                @error('title')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- @for ($i = 1; $i <= 10; $i++) <div class="form-group row">
                            <label for="problem0"
                                class="col-md-4 col-form-label text-md-right">{{ __('Problem').$i }}</label>

                        <div class="col-md-6">
                            <input id="problem{{$i - 1}}" type="text"
                                class="form-control @error('problem'.($i - 1)) is-invalid @enderror"
                                name="problem{{$i - 1}}" value="{{ old('title') }}" autocomplete="problem{{$i - 1}}"
                                autofocus>

                            @error('problem'.($i - 1))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>
                @endfor --}}


                <div class="">
                    <div class="">
                        <button type="submit" class="">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection