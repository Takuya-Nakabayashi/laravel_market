@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="{{ route('users.index') }}">
            Market
          </a>
        </li>
        <li>
        @if( Auth::check() )
            こんにちは、{{ Auth::user()->name }}さん！
        @endif
        </li>
        <li>
            <a href="{{ route('users.show','Auth::user()') }} ">
            プロフィール
        </li>
        <li>
          <a href="{{ route('likes.index') }}">
            お気に入り一覧
          </a>
        </li>
        <li>
            <a href="{{ route('users.exhibitions','Auth::user()') }}">
                出品商品一覧
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection