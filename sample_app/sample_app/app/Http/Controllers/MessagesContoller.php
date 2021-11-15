<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PhpParser\Node\Expr\Isset_;

class MessagesContoller extends Controller
{
    //テーブルからselectするメソッド
    public function index(){
        $title = 'シンプルな掲示板';
        $messages = \App\Message::all();
        return view('messages.index', [
            'title'     => $title,
            'messages'  => $messages,
        ]);
    }

    //テーブルへINSERTするメソッド（リクエスト処理）。Requestオブジェクトを指定、パラメータの引数として$requestを指定
    public function create(Request $request){
        //requestオブジェクトのvalidateメソッドを指定。 列名=>'ルール1|ルール2'のような記述
        $request->validate(
            [
                // nameのバリデーションを外す
                // 'name'  => 'required|max:20', //必須項目、20文字以内
                'body'  => 'required|max:100', //必須項目、100文字以内
                //列名=>'ルール1|ルール2'ではなく、配列でバリデーションメソッドを渡すことも可能
                'image' => [
                    'file',             //アップロードに成功したかどうか
                    'image',            //アップロードしたファイルが画像（拡張子がjpg、png、bmp、gif、svg)であるか
                    'mimes:jpeg,png',   //アップロードした画像が指定した拡張子リスト（今回はjpeg,png）のどれかと一致すること
                    // ファイルアップロードが行われ、画像ファイルでjpeg,pngのいずれか、100x100~600x600まで
                    'dimensions:min_width=100,min_height=100,max_width=600,max_height=600',
                ]
            ],
            //エラーコメントをカスタマイズしたい場合は'列名.ルール' => 'エラーコメント'で個別に設定可能
            [
                // 'name.required' => '名前は必須です。',
                'body.required' => 'コメントは必須です。',
                'name.max'   => '名前は20字以内で入力してください。',
                'body.max'  => 'コメントは100字以内で入力してください。',
            ],
        );

        //画像ファイル名を定義するため、一度から配列で定義
        $filename = '';
        //アップロードしたファイルの取得
        $image = $request->file('image');
        //ファイルの存在を確認
        if(isset($image)){
            //拡張子を取得
            $ext = $image->guessExtension();
            //アップロードファイル名は [ランダム文字列20文字].[拡張子]として保存する
            $filename = str_random(20) . ".{$ext}";
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }
        // Messageモデルを利用して空のMessageオブジェクトを作成
        $message = new \App\Message;
        //フォームの値を取得
        // $message->name = $request->name;
        //nameはログインユーザー名を利用
        $message->name = \Auth::user()->name;
        $message->body = $request->body;
        $message->image = $filename;
        //テーブルへINSERT
        $message->save();
        //一覧画面へリダイレクト
        return redirect('/messages');
    }

    public function __construct(){
        //authというミドルウェアを設定
        //MessagesControllerの各アクションが実行される前後にauthというミドルウェアの処理が実行される。
        $this->middleware('auth');
    }
}
