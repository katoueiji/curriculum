@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>参加ユーザー一覧</h2>
        </div>
    </div>

    <div class="row text-center fw-bold border-bottom py-2 mb-2">
        <div class="col-md-4">ユーザー名</div>
        <div class="col-md-4">メールアドレス</div>
        <div class="col-md-4">イベント名</div>
    </div>

    @foreach($eu as $eus)
    <div class="row align-items-center border py-2 mb-2 text-center">
        <div class="col-md-4">
            {{ $eus->user->name }}
        </div>
        <div class="col-md-4">
            {{ $eus->user->email }}
        </div>
        <div class="col-md-4">
            {{ $eus->event->title }}
        </div>
    </div>
    @endforeach
</div>
@endsection