@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>本当にキャンセルしますか？</h2>
        </div>
    </div> 
    <div class="row align-items-start mt-5"> 
        <div class="col-md-2 d-flex flex-column align-items-center ml-5">
            <img src="{{ asset('storage/profile/' . $event->image) }}"  class="img-thumbnail">
        </div>
    </div>

        <div class="col-md-6 card-body">
            <label class="fs-6">イベント名</label>
                 <div class="border rounded">
                    <h2 class="card-title ml-2">{{ $event->title }}</h2>
                </div>
            <label class="card-text mt-3 fs-6">イベント開催形式</label>
                <div class="border rounded">
                    @if($event->format == 0)
                        <p class="card-text fs-5 ml-2">zoom</p>
                    @else
                        <p class="card-text fs-5 ml-2">YouTube</p>
                    @endif
                </div>
            <label class="card-text mt-3 fs-6">日程</label>
                <div class="border rounded">
                    <p class="card-text fs-5 ml-2">{{ $event->date }}</p>
                </div>
            <label class="card-text mt-3 fs-6">定員数</label>
                <div class="border rounded">
                    <p class="card-text ml-2 fs-5">{{ $event->capacity }}人</p>
                </div>
            <label class="card-text mt-3 fs-6">紹介文</label>
                <div class="border rounded">
                    <p class="card-text fs-5 ml-2 ">{!! nl2br(e($event->comment)) !!}</p>
                </div>
        </div>

        <div class="row mt-3 justify-content-between text-center" style="height: 250px;">
            <div class="col-md-6 card-body d-flex flex-column justify-content-center">
                <form action="{{ route('user.join', ['id' => $user->id]) }}" method="get">
                    <button type="submit" class="btn btn-primary">戻る</button>
                </form>
            </div>
            <div class="col-md-6 card-body d-flex flex-column justify-content-center">
                <form action="{{ route('user.cancel', ['id' => $event->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">キャンセル</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection