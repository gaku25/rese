@extends('layouts.web-app')

@section('title')
@yield('back-button')
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
                @else
                <li class="nav_item"><a href="http://127.0.0.1:8000/register">Registration</a></li>
                @endif
                @if (Auth::check())
                <li class="nav_item"><a href="{{ route('mypage') }}">Mypage</a></li>
                @else
                <li class="nav_item"><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
            </nav>
            <div class="logo">
                Rese
            </div>
            </div>
            <div class="detail__ttl-btn">
        @if ($returnToPage === 'index')
    <a href="{{ route('index') }}" class="detail__btn">
        <
    </a>
@elseif ($returnToPage === 'mypage')
    <a href="{{ route('mypage') }}" class="detail__btn">
        <
    </a>
@endif

            <h1 class="detail__ttl">
            {{$store->store}}
            </h1>
            </div>
            <div class="practice__detail">
            <div class="detail__img">
                <img src="{{ $store->image }}" alt="イメージ写真"/>
            </div>
            <div class="detail__content">        
            <div class="tag">
                <p class="detail__tag">#{{ $area->area }}</p>
                <p class="detail__date">#{{ $genre->genre }}</p>
            </div>
            </div>
            <div class="detail__text">
            {{$store->overview}}
            </div>
            </div>
        </div>
        <div class="detail-sub">
            <div class="detail-reserve">
                <form action="{{ route('store.done') }}" method="post">
                        @csrf
                <div class="detail-reserve_sub">
                    <h1 class="detail-title">
                    予約
                    </h1>
                    <input id="date-input" type="datetime" class="detail-datatime" name="datetime" placeholder="2023/6/1">
                    <select id="time-select" name="time" class="select-time" required>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                    </select>
                    </br>
                    <select id="number-select" name="number" class="select-number">
                        <option value="2人">1人</option>
                        <option value="2人">2人</option>
                        <option value="3人">3人</option>
                        <option value="4人">4人</option>
                        <option value="5人">5人</option>
                        <option value="6人">6人</option>
                        <option value="7人">7人</option>
                        <option value="8人">8人</option>
                        <option value="9人">9人</option>
                        <option value="10人">10人</option>
                    </select>
                    <div class="detail-information">
                        <table class="detail-table">
                        <tr class="detail-information_title">
                            <th class="detail-information_shop detail-information_table">
                                Shop
                            </th>
                            <td class="detail-information_content" name="store">
                                {{$store->store}}
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_data detail-information_table">
                                Data
                            </th>
                            <td class="detail-information_content" id="data-content" name="datetime">
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_time detail-information_table">
                                Time
                            </th>
                            <td class="detail-information_content" id="time-content" name="time">
                            </td>
                        </tr>
                        <tr class="detail-information_title">
                            <th class="detail-information_number detail-information_table">
                                Number
                            </th>
                            <td class="detail-information_content" id="number-content" name="number">
                            </td>
                        </tr>
                        </table>
                    </div>    
                </div>
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <input type="submit" class="detail_btn detail_btn-sub" value="予約する">
                </form>
            </div>
            
                
        </div>
    </div>
<script>
    const dateInput = document.getElementById('date-input');
    const timeSelect = document.getElementById('time-select');
    const numberSelect = document.getElementById('number-select');

    dateInput.addEventListener('input', function() {
        const date = dateInput.value;
        const dateContent = document.getElementById('data-content');
        dateContent.textContent = date;
    });

    timeSelect.addEventListener('change', function() {
        const time = timeSelect.value;
        const timeContent = document.getElementById('time-content');
        timeContent.textContent = time;
    });

    numberSelect.addEventListener('change', function() {
        const number = numberSelect.value;
        const numberContent = document.getElementById('number-content');
        numberContent.textContent = number;
    });
</script>

@endsection


@section('content')
    
@endsection
