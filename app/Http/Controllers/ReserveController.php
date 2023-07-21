<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Http\Requests\ReserveRequest; 
use App\Models\ReserveManagement; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function store(ReserveRequest $request)
    {
        $validatedData = $request->validated();

        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->date = $validatedData['date'];
        $reserve->time = $validatedData['time'];
        $reserve->number = $validatedData['number'];
        $reserve->save();

    return redirect()->route('store.done');
    }

    public function done(Request $request)
    {
        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

    return view('done');
    }

    public function delete(Request $request, $id)
{
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();
    return redirect()->route('mypage')->with('message');
}
}
