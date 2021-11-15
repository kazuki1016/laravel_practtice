@extends('layouts.default')

@section('title', $title)


@section('content')
    <h1>{{ $title }}</h1>
    {{-- 以下を追記 --}}
    {{-- Auth::user()->nameでユーザー名を取得している --}}
    <p>現在のユーザー名: {{ Auth::user()->name }}</p>
    <form method="post" action="{{ url('/logout') }}">
        {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form>
    {{-- エラーメッセージを出力。Laravelの場合、バリデーションエラー時は自動的に元のページへリダイレクトされる --}}
    {{-- バリデーションエラーはグローバル変数の$errorsに保存される --}}
    @foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    @endforeach

    {{-- 以下にフォームを追記します。 --}}
    <form action="{{ url('/messages') }}" method="post" enctype="multipart/form-data">
        {{-- csrf対策。必須のようだ --}}
        {{ csrf_field() }}
        {{-- <div>
            <label for="name">
                名前:
                <input type="text" name="name" id="name" class="name_field" placeholder="お名前を入力">
            </label>
        </div> --}}
        <div>
            <label for="body">
                コメント：
                <input type="text" name="body" id="body" class="comment_field" placeholder="コメントを入力">
            </label>
        </div>
        <div>
            <label for="image">
                画像：
                <input type="file" name="image" id="image">
            </label>
        </div>
        <div>
            <input type="submit" value="投稿">
        </div>
    </form>
    <ul>
        @forelse ($messages as $message)
            <li>
                @if ($message->image !== '')
                    {{-- 画像ファイルを読み込む。 --}}
                    <img src="{{ asset('storage/photos/' . $message->image) }}">
                    <br>
                @endif
                {{ $message->name }};
                {{ $message->body }};
                {{ $message->created_at }}</li>
        @empty
            <li>メッセージはありません。</li>
        @endforelse
    </ul>
@endsection
