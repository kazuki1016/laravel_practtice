@extends('layouts.default')
@section('content')
    <h1>テーブルに登録してあるデータを全て表示する</h1>
    @foreach ($messages as $message)
    <p>
        {{ $message->name }};
        {{ $message->body }}
    </p>
    @endforeach
@endsection
