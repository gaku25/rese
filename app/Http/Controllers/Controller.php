<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth; 

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // ログインしているかどうかを全てのコントローラーメソッドでチェック
        $this->middleware(function ($request, $next) {
            $loggedIn = Auth::check();
            view()->share('loggedIn', $loggedIn);
            return $next($request);
        });
    }
}
