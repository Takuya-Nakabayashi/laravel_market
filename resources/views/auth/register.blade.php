@extends('layouts.not_logged_in')
 
@section('content')
<div class="center">
  <h1>ユーザー登録</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
      <label>
        <p>ユーザー名:</p>
        <input type="text" name="name">
      </label>
    </div>
 
    <div>
      <label>
        <p>メールアドレス:</p>
        <input type="email" name="email">
      </label>
    </div>
 
    <div>
      <label>
        <p>パスワード:</p>
        <input type="password" name="password">
      </label>
    </div>
 
    <div>
      <label>
        <p>パスワード（確認用）:</p>
        <input type="password" name="password_confirmation" >
      </label>
    </div>
 
    <div>
      <input type="submit" value="登録">
    </div>
  </form>
</div>
@endsection