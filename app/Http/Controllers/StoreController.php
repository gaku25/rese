<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
    if (Auth::check()) {
        $user = Auth::user();
        $stores = Store::all();
    foreach ($stores as $store) {
            $store->isFavorite = $user->favorites->contains('store_id', $store->id);
        }
    } else {
        $user = null;
        $stores = Store::all();
    }
        $areas = Area::all();
        $genres = Genre::all();
        $param = [
            'user' => $user,
            'stores' => $stores,
            'areas' => $areas,
            'genres' => $genres,
        ];
    return view('index',$param);
    }

    public function detail(Request $request, $id)
{
        $store = Store::find($id);
        $area = $store->area;
        $genre = $store->genre;
        $routeName = $request->route()->getName();
        $returnTo = $request->input('return_to');
    if ($returnTo !== 'index' && $returnTo !== 'mypage') {
        $returnTo = null; 
    }
        $returnToPage = ($returnTo === 'index') ? 'index' : 'mypage';
    if ($returnTo === null) {
        $returnToPage = $request->header('Referer') === route('mypage') ? 'mypage' : 'index';
    }
        $param = [
            'store' => $store,
            'area' => $area,
            'genre' => $genre,
            'returnTo' => $returnTo,
            'returnToPage' => $returnToPage,
    ];

    return view('detail', $param);
}

    public function done($id)
    {
        $reserveManagement = ReserveManagement::findOrFail($id);
    return view('done', compact('reserveManagement'));
    }

    public function thanks(Request $request)
    {
    return view('thanks');
    }

    public function search(Request $request)
{
        $input_area = $request->input('area');
        $input_genre = $request->input('genre');
        $keyword = $request->input('keyword');
        $query = Store::query();
    if ($input_area) {
        $query->where('area_id', $input_area);
    }
    if ($input_genre) {
        $query->where('genre_id', $input_genre);
    }
    if ($keyword) {
        $query->where('store', 'LIKE', "%$keyword%");
    }
        $stores = $query->get();
    if (Auth::check()) {
        $user = Auth::user();
        $userFavorites = $user->favorites->pluck('store_id')->toArray();

    foreach ($stores as $store) {
        $store->isFavorite = in_array($store->id, $userFavorites);
        }
    }
        $areas = Area::all();
        $genres = Genre::all();
        $param = [
            'stores' => $stores,
            'areas' => $areas,
            'genres' => $genres,
            'input_area' => $input_area,
            'input_genre' => $input_genre,
    ];
    return view('index', $param);
}

}