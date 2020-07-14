<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineBotController extends Controller
{   // LineBotContorollerにindexというメソッドを定義
    public function index()
    {
        return view('linebot.index'); // linebotフォルダの中のindexという名前のviewファイルを表示
    }

    public function parrot(Request $request)
    {
        // ログ出力設定
        Log::debug($request -> header());
        Log::debug($request -> input());

        // LINEBotクラスを生成(インスタンス化)する
        $httpClient = new CurlHTTPClient(env('LINE_ACCESS_TOKEN'));
        $lineBot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        // 署名の検証を行う
        $signature = $request -> header('x-line-signature');
        if (!$lineBot ->validateSignature($request -> getContent(), $signature)) {
            abort(400, 'Invalid signature');
        }

        // リクエストからイベントを取り出す
        $events = $lineBot -> parseEventRequest($request -> getContent(), $signature);

        Log::debug($events);

        // LINEのチャンネルに返信する
        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                Log::debug('Non text message has come');
                continue;
            }

            $replyToken = $event -> getReplyToken();
            $replyText = $event -> getText();
            $lineBot -> replyText($replyToken, $replyText);
        }
    }
}
