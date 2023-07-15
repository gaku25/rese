@extends('layouts.web-app')

@section('title')
    <div class="detail-content">
        <div class="detail-main">
            <div class="header-nav">
            <input id="drawer_input" class="drawer_hidden" type="checkbox">
            <label for="drawer_input" class="drawer_open"><span></span></label>
            <nav class="nav_content">
                <ul class="nav_list">
                <li class="nav_item"><a href="http://127.0.0.1:8000">Home</a></li>
                @if (Auth::check())
                <li class="nav_item"><a href="{{ route('logout') }}">Logout</a></li>
                <li class="nav_item"><a href="{{ route('mypage') }}">Mypage</a></li>
                @else
                <li class="nav_item"><a href="http://127.0.0.1:8000/register">Registration</a></li>
                <li class="nav_item"><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
            </nav>
            <div class="logo">
                Rese
            </div>
        </div>
    </div>        
@endsection

@section('content')
    <div class="mypage">
        <div class="mypage_register">
            <h2 class="mypage_register-tetle">
                予約状況
            </h2>
            @foreach($reserves as $reserve)
                <div class="mypage_register-page">
                    <div class="mypage_register-flex">
                    <span class="mypage_register-logo"></span>
                    <h3 class="mypage_register-situation">
                        予約1
                    </h3>
                    <form action="{{ route('reserve.delete', ['id' => $reserve->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="mypage_cancel">
                            <img id="" class="mypage_cancel-btn" src="{{ asset('storage/cancel.png') }}" alt="削除"/>   
                        </button>
                    </form>
                    </div>
                    <table class="detail-table">
                        <tr class="detail-information_title">
                            <th class="detail-information_shop detail-information_table">
                                Shop
                            </th>
                            <td class="detail-information_content">
                                {{ $reserve->store->store }}
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_data detail-information_table">
                                Data
                            </th>
                            <td class="detail-information_content" id="data-content">
                                {{ $reserve->datetime }}
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_time detail-information_table">
                                Time
                            </th>
                            <td class="detail-information_content" id="time-content">
                                {{ $reserve->time }}
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_number detail-information_table">
                                Number
                            </th>
                            <td class="detail-information_content" id="number-content">
                                {{ $reserve->number }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
        <div class="mypage_favorite">
            <div class="mypage__user">
                @if (Auth::check())
                    <div class="mypage__user-login">{{ Auth::user()->name }}さん</div>
                @else
                    <div class="mypage__user-logout">ログインしてください。</div>
                @endif
            </div>
            <h2 class="mypage_favorite-tetle">
                お気に入り店舗
            </h2>
            <div class="favorite__card-flex">
                @foreach($favorites as $favorite)
                    <div class="favorite__card mypage__card">
                        <div class="card__img">
                            <img src="{{ $favorite->store->image }}" alt="イメージ写真" />
                        </div>
                        <div class="card__content card__favorite">
                            <h1 class="card__ttl ttl__favorite">
                                {{ $favorite->store->store }}
                            </h1>
                            <div class="tag tag__favorite">
                                <p class="card__tag tag__favorite">#{{ $favorite->store->area->area }}</p>
                                <p class="card__date date__favorite">#{{ $favorite->store->genre->genre }}</p>
                            </div>
                            <div class="card__text">
                                <form action="{{ route('store.detail', ['id' => $favorite->store->id]) }}" method="get">
    <button class="card__cat" name="id" value="{{ $favorite->store->id }}" onclick="location.href='{{ route('store.detail', ['id' => $favorite->store->id, 'return_to' => 'mypage']) }}'">詳しく見る</button>
                                    <a href="{{ route('favorites.toggle', ['store_id' => $favorite->store->id]) }}">
                                    <img id="heart-{{ $favorite->store->id }}" class="card__heart{{ $favorite->store->isFavorite ? ' heart-active' : '' }}" src="{{ asset('storage/heart.png') }}" alt="お気に入り" style="float: right;"/>
                                </a>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection