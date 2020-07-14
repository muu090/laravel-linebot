<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineBotController extends Controller
{   // LineBotContorollerにindexというメソッドを定義
    public function index()
    {
        return view('linebot.index'); // linebotフォルダの中のindexという名前のviewファイルを表示
    }
}
