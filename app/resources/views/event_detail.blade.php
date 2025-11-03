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
            <img src="{{ asset('storage/profile/' . $event['image']) }}" class="img-thumbnail img-fluid rounded">

            @can('admin-higher') {{-- 管理者に表示される --}}
            <div class="mt-3 d-flex justify-content-around gap-3 w-100">
                <form action="{{ route('event.all') }}" class="flex-fill ml-2" method="get">
                    <button type="submit" class="btn btn-primary">戻る</button>
                </form>
                
                <form action="{{ route('event.hidden', ['id' => $event->id]) }}" class="flex-fill mr-3" method="get">
                    <button type="submit" class="btn btn-primary">非表示にする</button>
                </form>
            </div>
            @elsecan('user-higher') {{-- 一般ユーザーに表示される --}}
            <div class="mt-3 d-flex justify-content-around gap-3 w-100">
                <form action="{{ route('event.join', ['id' => $event->id]) }}" class="flex-fill ml-2" method="get">
                    <button type="submit" class="btn btn-primary w-100 fs-5">参加する</button>
                </form>

                <form action="{{ route('event.report', ['id' => $event->id]) }}" class="flex-fill mr-3" method="get">
                    <button type="submit" class="btn btn-danger w-100 fs-5">報告する</button>
                </form>
            </div>
            @endcan
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
                    <p class="card-text fs-5 ml-2">{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d H:i') }}</p>
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
    </div>
</div>

@endsection