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
        // 既にお気に入りに登録されているかチェック
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('store_id', $request->store_id)
            ->first();
    if ($existingFavorite) {
        // 既に登録されている場合は何もしない
        return response()->json(['message' => 'Already added to favorites'], 200);
    }
        // 新しいお気に入りを作成
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'store_id' => $request->store_id,
        ]);
        // お気に入りフラグを追加
        $favorite->store->isFavorite = true;
    return response()->json(['message' => 'Favorite added successfully', 'favorite' => $favorite], 201);
}

    public function remove(Request $request)
{
        $user = Auth::user();
    // お気に入りから削除する
        Favorite::where('user_id', $user->id)
            ->where('store_id', $request->store_id)
            ->delete();
    return response()->json(['message' => 'Favorite removed successfully'], 200);
}

    public function toggle(Request $request, $store_id)
{
        $user = Auth::user();
    // 既にお気に入りに登録されているかチェック
        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('store_id', $store_id)
            ->first();
    if ($existingFavorite) {
        // 既に登録されている場合は削除する
        $existingFavorite->delete();
        $isFavorite = false;
    } else {
        // まだ登録されていない場合は追加する
        Favorite::create([
            'user_id' => $user->id,
            'store_id' => $store_id,
        ]);
        $isFavorite = true;
    }

    if ($request->ajax()) {
    return response()->json([
        'message' => 'Favorite ' . ($isFavorite ? 'added' : 'removed') . ' successfully',
        'isFavorite' => $isFavorite,
    ], 200);
    }

    return redirect()->route('mypage');
}
}