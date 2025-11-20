@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>全イベント一覧</h2>
        </div>
    </div>   

    <div class="d-flex justify-content-between text-center fw-bold p-2">
        <div class="col-md-2">
            <h5>イベント名</h5>
        </div>
        <div class="col-md-2">
            <h5>主催者名</h5>
        </div>
        <div class="col-md-2">
            <h5>報告数</h5>
        </div>
        <div class="col-md-2">
            <h5>操作</h5>
        </div>
    </div>
    @foreach($event as $events)
    <div class="d-flex justify-content-between align-items-center border p-2 mb-2" style="height: 70px;">
        <div class="col-md-2 text-center">
            <p class="m-0" >{{ $events->title }}</p>
        </div>

        <div class="col-md-2 text-center">
            <p class="m-0">{{ $events->user->name }}</p>
        </div>

        <div class="col-md-2 text-center">
            <p class="m-0">{{ count($events->reports) }}件</p>
        </div>
            <div class="col-md-2 d-flex gap-1 align-items-center justify-content-center">
            @if($events->is_visible == 0)
                <form action="{{ route('event.hidden', ['id' => $events->id]) }}" method="get">
                    <button type="submit" class="btn btn-warning px-3">非表示</button>
                </form>
            @else
                <form action="{{ route('event.active', ['id' => $events->id]) }}" method="get">
                    <button type="submit" class="btn btn-primary px-3">再表示</button>
                </form>
            @endif
                <form action="{{ route('event.detail', ['id' => $events->id]) }}" method="get">
                    <button type="submit" class="btn btn-primary px-3">詳細</button>
                </form>
            </div>
    </div>
    @endforeach
    <div class="mt-4 d-flex justify-content-end">
    {{ $event->links() }}
    </div>
</div>


@endsection