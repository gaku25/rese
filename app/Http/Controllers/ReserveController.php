<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\ReserveManagement; 
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function store(ReserveRequest $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'number' => 'required',
        ]);
        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

    return redirect()->route('store.done');
    }

    public function done(Request $request)
{
    if (!Auth::check()) {
        Session::flash('message', '予約を行うにはログインしてください。');
    return redirect()->route('login');
    }
        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();
    return view('done')->with('message', '予約が完了しました。');
    }

    public function delete(Request $request, $id)
{
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();
    return redirect()->route('mypage')->with('message');
}
}
