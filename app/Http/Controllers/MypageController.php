<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use App\Models\Contact;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function mypage()
{
    $user = Auth::user();
    $store = Store::first(); // 例として最初の店舗を取得する
    $param = [
        'user' => $user,
        'store' => $store, // $store変数を追加
    ];
    return view('mypage', $param);
}
}
