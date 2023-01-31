@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
   @forelse($like_items as $like_item)
    <li class="item">
      <div class="item_image">
        @if($like_item->image !== '')
          <a href="{{route('items.show',$like_item->id)}}"><img src="{{ asset('storage/' . $like_item->image) }}"></a>
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
        {{ $like_item->description }}
        </div>
        <div>
          商品名:{{ $like_item->name }} {{ $like_item->price }}円
        </div>
         @if($like_item->isOrderedBy($like_item))
          <p class="sold">売り切れ</p>
          @else
          @endif
        <div>
          カテゴリ:{{ $like_item->category->name }} {{ $like_item->created_at }}
        </div>
    </li>
  @empty
    <li>商品はありません。</li>
  @endforelse
</div>
@endsection