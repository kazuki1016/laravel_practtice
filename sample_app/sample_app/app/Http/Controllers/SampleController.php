<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mockery\Matcher\Any;

class SampleController extends Controller
{
    //ここに関数を定義して様々な機能を追加
    public function sample_action() {
        $title = 'コントローラーを利用したサンプル';
        $description = 'コントローラーを利用すると、ルーティングでphpの処理を書く必要がなくなります。';
        return view('blade_sample', [
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function practice () {
        $title = '練習問題';
        $practice = '課題の例です';
        return view('practice', [
            'title' => $title,
            'practice' => $practice,
        ]);
    }

    //messageテーブルから最初の一行目を取り出す関数
    public function message_sample(){
        //firstメソッドを使用することでテーブルから最初の一行目を取り出す
        $message = \App\Message::all()->first();
        //viewメソッドでblade名がmessage_sampleのファイルを呼び出す。
        return view('message_sample', [
            //message_sample.blade.phpの中の$message（'message'）を$messageに置換する
            'message' => $message
        ]);
    }
    public function message_practice(){
        //テーブルに登録されているデータ全てを取り出す
        $messages = \App\Message::all();
        return view('message_practice',[
            'messages' => $messages
        ]);
    }
    public function blade_example(){
        $title = 'bladeテンプレートの様々な機能';
        $num = 10;
        $messages = \App\Message::all();
        // $messages = [];
        return view('blade_example', [
            'title' => $title,
            'num' => $num,
            'messages' => $messages,
        ]);
    }
}
