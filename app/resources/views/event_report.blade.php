@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>イベント詳細</h2>
        </div>
    </div>

    <div class="row mt-3 align-items-start"> 
        <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="card">
                    <img src="{{ asset('storage/profile/' . $event->image) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                     <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        @if($event->format == 0)
                        <p class="card-text">イベント形式：zoom</p>
                        @else
                        <p class="card-text">イベント形式：YouTube</p>
                        @endif
                        <p class="card-text">日程：{{ $event->date }}</p>
                    </div>
                </div>
        </div>
        <div class="col-md-6 card-body d-flex flex-column justify-content-center" style="min-height: 400px;">
            <h3 class="text-center">このイベントを報告しますか？</h3>
            <form action="{{ route('event.report', ['id' => $event->id]) }}" method="POST">
                @csrf
                <label class="card-text mt-5 fs-6">報告コメント</label>
                    @error('comment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                <textarea type='text' class='form-control' name='comment' rows="5"></textarea>
                <p class="text-center fs-5 mt-5">確認ボタンにて<br>マイページの参加イベントの欄に<br>追加されます。</p>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger w-75 mt-3 btn-lg">報告する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection