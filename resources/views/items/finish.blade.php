@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
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
    <a href="{{route('users.index')}}">トップに戻る</a>
</div>
@endsection