@extends('layouts.not_logged_in')
 
@section('content')
<div class="center">
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
      @csrf
      <div>
          <label>
            <p>メールアドレス:</p>
            <input type="email" name="email">
          </label>
      </div>
 
      <div>
          <label>
            <p>パスワード:</p>
            <input type="password" name="password" >
          </label>
      </div>
 
      <input type="submit" value="ログイン">
  </form>
</div>
@endsection