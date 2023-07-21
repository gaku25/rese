@extends('layouts.web-app')

@section('title')
    <header class="header">
    <!-- ハンバーガーメニュー部分 -->
    <div class="header-nav">
        <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
    
        <!-- ハンバーガーアイコン -->
        <label for="drawer_input" class="drawer_open"><span></span></label>
    
        <!-- メニュー -->
        <nav class="nav_content">
            <ul class="nav_list">
                <li class="nav_item">
                    <a href="http://127.0.0.1:8000">
                        Home
                    </a>
                </li>
                @if (Auth::check())
                <li class="nav_item">
                    <a href="{{ route('logout') }}">
                        Logout
                    </a>
                </li>
                <li class="nav_item">
                    <a href="{{ route('mypage') }}">
                        Mypage
                    </a>
                </li>
                @else
                <li class="nav_item">
                    <a href="http://127.0.0.1:8000/register">
                        Registration
                    </a>
                </li>
                <li class="nav_item">
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- ヘッダーロゴ -->

        <div class="logo">
            Rese
        </div>
    </div>
    </header>
@endsection
        
@section('content')
    <div class="thanks__card">
    <div class="thanks__tetle">
        ご予約ありがとうございます
    </div>    
    <form class="thanks__btn" action="/" method="get">
        <button class="card__cat" name="" value="">
            戻る
        </button>
    </form>
    </div>
@endsection
