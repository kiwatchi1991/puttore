@extends('layouts.app')

@section('content')

<div class="c-lessonShow">
    <div class="c-lessonShow__inner">
        {{-- 出品者 --}}
        <div class="c-lessonShow__user">
            <div class="c-lessonShow__userimg">
                <img src="/storage/{{ $user[0]->pic }}" alt="">
            </div>
            <div class="c-lessonShow__username">
                <p>{{ $user[0]->account_name }}</p>
            </div>
        </div>

        {{-- タイトル --}}
        <div class="c-lessonShow__title">
            <h2>{{ $product->name }}</h2>
        </div>

        {{-- タグ --}}
        <div class="c-tag__block">

            {{-- 言語表示 --}}
            @foreach ($product->categories as $category)

            <div class="c-tag c-tag--category {{ $category->class_name }}">{{ $category->name }}</div>
            @endforeach

            {{-- 難易度表示 --}}
            @foreach ($product->difficulties as $difficulty)

            <div class="c-tag c-tag--difficulty {{ $difficulty->class_name }}">{{ $difficulty->name }}</div>

            @endforeach
        </div>

        {{-- レッスンタイトル --}}
        <div class="c-lessonShow__lesson">
            <div class="c-lessonShow__lesson__number">LESSON {{ $this_lesson->number }}</div>
            <div class="c-lessonShow__lesson__title"> {{ $this_lesson->title }}</div>
            <div id="js-lessonShow__preview" class="c-lessonShow__lesson__contents">
                <input id="js-lessonShow__getText" type="hidden" value="{{ $this_lesson->lesson }}">
                {{ $this_lesson->lesson }}
            </div>
        </div>


        <div class="c-lessonShow__toLessons">
            @foreach ($all_lessons as $all_lesson)

            <div class="c-lessonShow__toLesson @if($l_id == $all_lesson->number)active @endif">
                <a href="{{ route('lessons',['p_id' => $p_id ,'l_id' => $all_lesson->number]) }}">LESSON
                    {{$all_lesson->number}}</a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection　▶︎