@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>参加イベント一覧</h2>
        </div>
    </div>   

    <div class="row mt-3 ml-2">
        @foreach($events as $event)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img src="{{ asset('storage/profile/' . $event['image']) }}" class="card-img-top" style="height: 220px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title"><a class= "text-decoration-none text-dark" href="{{ route('event.detail', ['id' => $event['id']]) }}">{{ $event['title'] }}</a></h5>
                    @if($event['format'] == 0)
                    <p class="card-text">イベント形式：zoom</p>
                    @else
                    <p class="card-text">イベント形式：YouTube</p>
                    @endif
                    <p class="card-text">日程：{{ $event['date'] }}</p>
                    <div class="d-flex">
                        <a href="{{ route('event.detail', ['id' => $event['id']]) }}" class="btn btn-primary d-grid w-50">イベント詳細</a>
                        <a href="{{ route('user.cancel', ['id' => $user['id']]) }}" class="btn btn-primary d-grid w-50 ml-2">参加取り消し</a>
                    </div>
                </div>                    
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection