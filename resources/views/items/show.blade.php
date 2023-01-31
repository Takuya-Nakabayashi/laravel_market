@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
    <h1>{{ $title }}</h1>
    @if (isset($items->id))
    <div>
        <div>
            <p class="bold">商品名</p>
            {{ $items->name }}
        </div>
        <div>
            <p class="bold">画像</p>
            <div class="item_img">
                @if($items->image !== '')
                  <img src="{{ asset('storage/' . $items->image) }}">
                @else
                  <img src="{{ asset('images/no_image.png') }}">
                @endif
            </div>
        </div>
        <p class="bold">カテゴリ</p>
        <p>{{ $items->category->name }}</p>
        <p class="bold">価格</p>
        <p>{{ $items->price }}円</p>
        <p class="bold">説明</p>
        <p>{{ $items->description }}</p>
    @if($items->user_id ===  \Auth::user()->id)
     
    　@else   
        @if($items->isOrderedBy($items))
            <p class="sold">申し訳ございません、売り切れてしまいました。</p>
        @else
            <a href="{{route('items.confirm',$items->id)}}"><input type="submit" value="購入する"></a>
        @endif
    @endif
  </div>
  @else
    その商品はありません
  @endif
</div>
@endsection