@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.update', $item) }}">
      @csrf
      @method('patch')
      <input type="hidden" name="id" value="{{ $item->id }}"> 
      <div>
          <label>
            <p>商品名:</p>
            <input type="text" name="name" value="{{ $item->name }}" >
          </label>
      </div>
      <div>
        <label>
          <p>商品説明:</p>
          <textarea  name="description" rows="5" cols="80">{{ $item->description }}</textarea>
        </label>
      </div>
      <div>
        <label>
          <p>価格:</p>
          <input type="number" name="price" value="{{ $item->price }}">
        </label>
      </div>
      <div>
        <label>
          <p>カテゴリー:</p>
          <select class="form-control" id="id" name="category_id">
            @foreach($categories as $category)
              <option value="{{ $category->id }}" @if($category->id==$item->category_id) selected @endif>{{ $category->name }}</option>
            @endforeach
          </select>
        </label>
      </div>
    <input type="submit" value="出品">
</div>
@endsection