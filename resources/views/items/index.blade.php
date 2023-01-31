@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<ul class="items">
  <h1>{{ $title }}</h1>
  <a href="{{ route('items.create') }}">新規出品</a>
  @forelse($items as $item)
    <li class="item">
      <div class="item_image">
        @if($item->image !== '')
          <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
        {{ $item->description }}
        </div>
        <div>
          商品名:{{ $item->name }} {{ $item->price }}円
        </div>
        <div>
          カテゴリ:{{ $item->category->name }} {{ $item->created_at }}
        </div>
        <div>
          [<a href="{{ route('items.edit') }}">編集</a>] [<a href="{{ route('items.editimage') }}">画像を変更</a>]
        </div>
        <form class="delete" method="post" action="{{ route('posts.destroy', $item) }}">
          @csrf
          @method('DELETE')
          <input type="submit" value="削除">
        </form>
    </li>
  @empty
    <li>出品している商品はありません。</li>
  @endforelse
</ul>  
@endsection