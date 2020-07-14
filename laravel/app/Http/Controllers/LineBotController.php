<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class LineBotController extends Controller
{   // LineBotContorollerにindexというメソッドを定義
    public function index()
    {
        return view('linebot.index'); // linebotフォルダの中のindexという名前のviewファイルを表示
    }

    public function parrot(Request $request)
    {
        Log::debug($request -> header());
        Log::debug($request -> input());
    }
}
