<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messageモデルの利用</title>
</head>
<body>
    <h1>Messageモデルの利用</h1>
    <p>
        {{-- コントローラーで定義した変数$messageを展開。変数->カラム名で定義 --}}
        {{ $message->name }};
        {{ $message->body }}
    </p>
</body>
</html>
