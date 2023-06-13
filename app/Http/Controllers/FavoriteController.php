<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add(Request $request)
{
    $user = Auth::user();

    // すでにお気に入りに登録されているかを確認
    $favorite = Favorite::where('user_id', $user->id)
                        ->where('store_id', $request->store_id)
                        ->first();

    if (!$favorite) {
        // お気に入りに追加されていない場合のみ追加する
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'store_id' => $request->store_id,
        ]);

        return response()->json(['message' => 'Favorite added successfully.']);
    }

    return response()->json(['message' => 'Already added to favorites.']);
}

public function remove(Request $request)
{
    $user = Auth::user();

    // お気に入りから削除する
    $favorite = Favorite::where('user_id', $user->id)
                        ->where('store_id', $request->store_id)
                        ->delete();

    return response()->json(['message' => 'Favorite removed successfully.']);
}

    public function toggle(Request $request)
{
    $user = Auth::user();

    // お気に入りが存在するかを確認
    $favorite = Favorite::where('user_id', $user->id)
                        ->where('store_id', $request->store_id)
                        ->first();

    if (!$favorite) {
        // お気に入りに追加されていない場合は追加する
        Favorite::create([
            'user_id' => $user->id,
            'store_id' => $request->store_id,
        ]);

        return response()->json(['message' => 'Favorite added successfully.']);
    } else {
        // お気に入りに既に追加されている場合は削除する
        $favorite->delete();

        return response()->json(['message' => 'Favorite removed successfully.']);
    }
}
}
