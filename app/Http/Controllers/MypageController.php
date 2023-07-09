<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use App\Models\favorite;
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
        $reserves = Reserve::where('user_id', $user->id)->get();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $param = [
            'user' => $user,
            'reserves' => $reserves,
            'favorites' => $favorites,
        ];
        return view('mypage', $param);
    }
}
