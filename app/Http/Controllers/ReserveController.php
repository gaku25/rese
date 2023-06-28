<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\ReserveManagement; 
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function store(ReserveRequest $request)
    {
        $validatedData = $request->validate([
            'datetime' => 'required',
            'time' => 'required',
            'number' => 'required',
        ]);

        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->datetime = $request->datetime;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

        return redirect()->route('store.done');
    }

    public function done(Request $request)
    {
        $user = Auth::user();
        $reserve = new Reserve();
        $reserve->user_id = $user->id;
        $reserve->store_id = $request->store_id;
        $reserve->datetime = $request->datetime;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

    return view('done');
    }
}
