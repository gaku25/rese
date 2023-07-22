@extends('layouts.web-app')

@section('title')
    <header class="header">
    <!-- ハンバーガーメニュー部分 -->
    <div class="header-nav">
        <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
    
        <!-- ハンバーガーアイコン -->
        <label for="drawer_input" class="drawer_open">
            <span>                
            </span>
        </label>
    
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
            <div>
                <form class="header-search" action="{{ route('store.search') }}" method="get">
                <div class="header-search_area">
                        <select name="area" class="select-area">
                        <option value="">
                            ALL&nbsp;area
                        </option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" name="keyword" @if(isset($input_area)) @if( $area->
                            id == $input_area) selected @endif @endif>{{ $area->area }}
                        </option>
                        @endforeach
                        </select>
                </div>
                <div class="header-search_genre">
                        <select name="genre" class="select-genre">
                        <option value="">
                            ALL&nbsp;genre
                        </option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" name="keyword" @if(isset($input_genre)) @if( $genre->
                            id == $input_genre) selected @endif @endif>{{ $genre->genre }}
                        </option>
                        @endforeach
                        </select>
                </div>
                <div class="header-search_text">
                    <span class="select-icon">
                    </span>
                    <input type="text" name="keyword" class="select-text" placeholder="Search...">
                </div>
                </form>
            </div>
    </header>
@endsection
        
@section('content')
    <div class="flex__item">
    @foreach ($stores as $store)
    <div class="practice__card">
    <div class="card__img">
        <img src="{{ $store->image }}" alt="イメージ写真" />
    </div>
    <div class="card__content">
        <h1 class="card__ttl">
        {{ $store->store }}
        </h1>
        <div class="tag">
        <p class="card__tag">
            #{{ $store->area->area }}
        </p>
        <p class="card__date">
            #{{ $store->genre->genre }}
        </p>
        </div>
        <div class="card__text">
        <form action="{{ route('store.detail', ['id' => $store->id]) }}" method="get">
            <button class="card__cat" name="id" value="{{ $store->id }}" onclick="location.href='{{ route('store.detail', ['id' => $store->id, 'return_to' => 'index']) }}'">
                詳しく見る
            </button>
                <a href="#" onclick="event.preventDefault(); toggleFavorite({{ $store->id }}, '{{ route('favorites.toggle', ['store_id' => $store->id]) }}', {{ $store->isFavorite ? 'true' : 'false' }}, '{{ route('mypage') }}')">
                    <img id="heart-{{ $store->id }}" class="card__heart{{ $store->isFavorite ? ' heart-active' : '' }}" src="{{ asset('storage/heart.png') }}" alt="いいね" style="float: right;"/>
                </a>
        </form>
        </div>
    </div>
    </div>
    @endforeach
    </div> 
        
<script>
    function toggleFavorite(storeId, url, isFavorite, redirectUrl) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const heartButton = document.getElementById('heart-' + storeId);

    // お気に入り追加/削除のAJAXリクエストを送信
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ store_id: storeId }),
    })
    .then(response => response.json())
    .then(data => {
        // レスポンスに応じた処理を実装
        console.log(data.message);

        // ハートボタンのスタイルを変更
        heartButton.classList.toggle('heart-active', data.isFavorite);

        // マイページへのリダイレクト
        if (data.redirect) {
            window.location.href = redirectUrl;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>

@endsection
