@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
  @if ($errors->any())
    @foreach ($errors as $error)
      <p class="validation">{{$error}}</p>
    @endforeach
  @endif
  <ul class="profile_img">
    @if($user->image !== '')
      <img src="{{ asset('storage/' . $user->image) }}">
    @else
      <img src="{{ asset('images/no_image.png') }}">
    @endif
    <a class="a" href="{{ route('profile.edit_image')}}">画像を変更</a>
  </ul>
  <p>{{ $user->name }}さん <a href="{{ route('profile.edit') }}">プロフィール編集</a></p>
  <ul class="profile">自己紹介:
    <div>
      @if($user->profile !== '')
        {{ $user->profile }} 
      @else
        プロフィールが設定されていません。
      @endif
     </div>
  </ul>
  <ul class="profile">
    <p>出品数:{{ $count }}</p>
  </ul>
  <ul class="profile">
    <p>購入履歴</p>
    @forelse($orders as $order )
      <li><a href="{{ route('items.show',$order->item_id)}}">{{ $order->item->name }}</a>: {{ $order->item->price }}円　出品者:{{ $order->item->User->name }}</li>
    @empty
      <li>購入履歴はありません。</li>
    @endforelse
  </ul>
</div>
@endsection