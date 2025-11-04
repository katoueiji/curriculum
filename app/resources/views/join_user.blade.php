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

    <div class="d-flex justify-content-between text-center fw-bold p-2">
        <div class="col-md-4">
            <h5>ユーザー名</h5>
        </div>
        <div class="col-md-4">
            <h5>メールアドレス</h5>
        </div>
        <div class="col-md-4">
            <h5>イベント名</h5>
        </div>
    </div>

    @foreach($eu as $eus)
    <div class="row align-items-center border p-2 mb-2 text-center" style="height: 70px;">
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
    <div class="mt-4 d-flex justify-content-end">
    {{ $eu->links() }}
    </div>
</div>
@endsection