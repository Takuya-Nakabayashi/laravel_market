@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
    <h1 class="top_title">{{ $title }}</h1>
    <a href="{{ route('items.create') }}">新規出品</a>
    @forelse($other_exhibitions as $other_exhibition)
    <li class="item">
        <div class="item_main_body">
            <div class="item_image">
                @if($other_exhibition->image !== '')
                    <a href="{{route('items.show',$other_exhibition->id)}}"><img src="{{ asset('storage/' . $other_exhibition->image) }}"></a>
                @else
                     <img src="{{ asset('images/no_image.png') }}">
                @endif
                <div class="description">
                    {{ $other_exhibition->description }}
                </div>
             </div>
                <div>
                    商品名:{{ $other_exhibition->name }} {{ $other_exhibition->price }}円
                    <a class="like_button">{{ $other_exhibition->isLikedBy(Auth::user())  ? '★' : '☆' }}</a>
                    <form method="post" class="like" action=" {{ route('users.toggle_like',$other_exhibition) }} ">
                        @csrf
                        @method('patch')
                    </form>
                    @if($other_exhibition->isOrderedBy($other_exhibition))
                        売り切れ
                    @endif
                </div>
            <div>
                カテゴリ:{{ $other_exhibition->category->name }} {{ $other_exhibition->created_at }}
             </div>
         </div>   
    </li>
    @empty
        <li>商品はありません。</li>
    @endforelse
</div>

  <script>
    /* global $ */
    $('.like_button').each(function(){
      $(this).on('click', function(){
        $(this).next().submit();
      });
    });
  </script>
@endsection