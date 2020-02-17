@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <div class="">{{ __('Drill Register') }}</div>

                <div class="">
                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        <div class="">
                            <label for="title" class="">{{ __('Title') }}</label>

                            <div class="">
                                <input id="title" type="text" class=" @error('title') is-invalid @enderror"
                                    name="title" value="{{ $product->title }}" autocomplete="title" autofocus>

                                @error('title')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <label for="description"
                                class="">{{ __('description') }}</label>

                            <div class="">
                                <input id="description" type="text"
                                    class="f @error('description') is-invalid @enderror" name="description"
                                    value="{{ $product->description }}" autocomplete="description" autofocus>

                                @error('title')
                                <span class="" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <label for="pic" class="">{{ __('Pic') }}</label>

                            <div class="">
                                <input id="pic" type="text" class=" @error('pic') is-invalid @enderror"
                                    name="pic" value="{{ $product->pic }}" autocomplete="pic" autofocus>

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