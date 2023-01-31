@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main_center">
  <h1>{{ $title }}</h1>
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('patch')
       <input type="hidden" name="id" value="{{ Auth::user()->id }}"> 
      <div>
          <label>
            名前:
            <input type="text" name="name" value="{{ Auth::user()->name }}">
          </label>
      </div>
      <div>
        <label>
          プロフィール:<br>
          <textarea type="text" name="profile" rows="5" cols="80">{{ Auth::user()->profile }}</textarea>
        </label>
      </div>
    <input type="submit" value="更新">
  </form>
</div>
@endsection