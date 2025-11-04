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
            <h5>ユーザー名</h5>
        </div>
        <div class="col-md-2">
            <h5>主催数</h5>
        </div>
        <div class="col-md-2">
            <h5>参加数</h5>
        </div>
        <div class="col-md-2">
            <h5>操作</h5>
        </div>
    </div>
        @foreach($user as $users)
        <div class="d-flex justify-content-between align-items-center border p-2 mb-2" style="height: 70px;">
            <div class="col-md-2 text-center">
                <p class="m-0" >{{ $users->name }}</p>
            </div>
            <div class="col-md-2 text-center">
                <p class="m-0">{{ $users->event_count }}</p>
            </div>
            <div class="col-md-2 text-center">
                <p class="m-0">{{ $users->event_user_count }}</p>
            </div>

            <div class="col-md-2 d-flex gap-1 align-items-center justify-content-center">
                <form action="{{ route('user.profile', ['id' => $users]) }}" method="get">
                    <button type="submit" class="btn btn-primary">詳細</button>
                </form>

                @if($users['is_active'] == 0)
                    <form action="{{ route('user.hidden', ['id' => $users['id']]) }}" method="get">
                        <button type="submit" class="btn btn-danger warning">利用停止</button>
                    </form>
                @else
                    <form action="{{ route('user.active', ['id' => $users['id']]) }}" method="get">
                    <button type="submit" class="btn btn-primary">利用停止解除</button>
                    </form>
                 @endif
            </div>
        </div>
        @endforeach
    <div class="mt-4 d-flex justify-content-end">
    {{ $user->links() }}
    </div>
</div>
    @endsection