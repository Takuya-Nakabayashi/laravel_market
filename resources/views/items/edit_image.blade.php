@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
  <h2>現在の画像</h2>
    @if($item->image !== '')
      <img src="{{ asset('storage/' . $item->image) }}">
    @else
      <li>画像はありません。</li>
    @endif
    <form
        method="POST"
        action="{{ route('items.update_image', $item) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')
        <div>
          <label>
            画像を選択:
            <input type="file" name="image">
          </label>
        </div>
      <input type="submit" value="更新">
    </form>
</div>
@endsection