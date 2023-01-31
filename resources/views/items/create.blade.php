@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
    <h1>{{ $title }}</h1>
    <h2>商品追加フォーム</h2>
    @if ($errors->any())
        @foreach ($errors as $error)
            <p class="validation">{{$error}}</p>
        @endforeach
    @endif
    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
         @csrf
        <div>
          <label>
            <p>商品名:</p>
            <input type="text" name="name"{{old('name')}} >
          </label>
      </div>
      <div>
        <label>
          <p>商品説明:</p>
          <textarea name="description" {{old('description')}} rows="5" cols="80"></textarea>
        </label>
      </div>
      <div>
          <label>
              <p>価格:</p>
              <input type="number" name="price" {{old('price')}}>
          </label>
      </div>
      <div>
        <label>
          <p>カテゴリー:</p>
          <select class="form-control" id="id" name="category_id">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </label>
      </div>
      <div>
        <label>
            <p>画像を選択:
            <input type="file" name="image">
        </label>
      </div>
      <input type="submit" value="出品">
  </form>
</div>
@endsection