@extends('layouts.logged_in')
 
@section('content')
 
  <div class="main_center">
    <div>
     <span class="bold">商品名</span>
      <p>{{ $item->name }}</p>
    </div>
    <div>
      <span class="bold">画像</span>
      @if($item->image !== '')
        <p><img src="{{ asset('storage/' . $item->image) }}"></p>
      @else
        <p><img src="{{ asset('images/no_image.png') }}"></p>
      @endif
      </div>
    <span class="bold">カテゴリ</span>
    <p>{{ $item->category->name }}</p>
    <span class="bold">価格</span>
    <p>{{ $item->price }}円</p>
    <span class="bold">説明</span>
    <p>{{ $item->description }}</p>
    <a href="{{ route('items.finish',$item->id) }}"><input type="submit" name="buy" value="内容を確認し、購入する"></a>
  </div>
@endsection