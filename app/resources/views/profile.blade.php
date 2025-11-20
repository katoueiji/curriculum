@extends('layouts.app')

@section('content')
<div class="container">
    @can('user-higher') {{-- 一般ユーザーに表示される --}}
    <div class="d-flex justify-content-between">
        <div class="col-md-2">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="col-md-2 card-body text-center">
            <h2>プロフィール</h2>
        </div>
        <div  class="col-md-2">
            <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="get">
                <button type="submit" class="btn btn-dark">ログアウト・退会</button>
            </form> 
        </div>
    </div>   

    <div class="row align-items-start mt-5"> 
        <div class="col-md-2 d-flex flex-column align-items-center ml-5">
            <img src="{{ $date && $date->image ? asset('storage/profile/' . $date->image) : asset('storage/profile/default.png') }}"   class="img-thumbnail">
        </div>
        <div class="col-md-4 card-body">
                <h4>{{ $user->name }}</h4>
                <p class="mt-3">{!! nl2br(e($date->comment ?? '')) !!}</p>
        </div>
        <div class="col-md-2 card-body text-center mr-4">
            <form action="{{ route('profile.edit', ['id' => $user->id]) }}" method="get">
                <button type="submit" class="btn btn-primary w-50 fs-5">プロフィール編集</button>
            </form>
        </div>
        <div class="text-center d-flex mt-5">
            <div class="col-md-4 card-body">
                <p>主催イベント数：{{ $main }}</p>
                <form action="{{ route('event.main', ['id' => $user->id]) }}" method="get">
                    <button type="submit" class="btn btn-warning w-50 fs-5">主催イベント一覧</button>
                </form>
            </div>
            <div class="col-md-4 card-body">
                <p>参加イベント数：{{ $join }}</p>
                <form action="{{ route('user.join', ['id' => $user->id]) }}" method="get">
                    <button type="submit" class="btn btn-primary w-50 fs-5">参加イベント一覧</button>
                </form>
            </div>
            <div class="col-md-4 card-body">
                <p>ブックマーク一覧</p>
                <form action="{{ route('bookmark') }}" method="get">
                    <button type="submit" class="btn btn-success w-50 fs-5">ブックマーク一覧</button>
                </form>
            </div>
        </div>
    </div>
    @elsecan('admin-higher') {{-- 管理者に表示される --}}
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>プロフィール</h2>
        </div>
    </div> 
    <div class="row align-items-start mt-5"> 
        <div class="col-md-2 d-flex flex-column align-items-center ml-5">
            <img src="{{ asset('storage/profile/' . $date->image) }}"  class="img-thumbnail">
        </div>
        <div class="col-md-4 card-body">
                <h4>{{ $user->name }}</h4>
                <p>{!! nl2br(e($user->comment ?? '')) !!}</p>
        </div>
    </div>
    <div class="row mt-3 justify-content-between text-center" style="height: 250px;"> 
        <div class="col-md-6 card-body d-flex flex-column justify-content-center">
            <form action="{{ route('user.all', ['id' => $user->id]) }}" method="get">
                <button type="submit" class="btn btn-primary btn-lg w-50 fs-3 mt-4">戻る</button>
            </form>
        </div>
        <div class="col-md-6 card-body d-flex flex-column justify-content-center">
        @if($user->is_active == 0)
            <form action="{{ route('user.hidden', ['id' => $user->id]) }}" method="get">
            <button type="submit" class="btn btn-danger btn-lg w-50 fs-3 mt-4">利用停止</button>
            </form>
        @else
            <form action="{{ route('user.active', ['id' => $user->id]) }}" method="get">
            <button type="submit" class="btn btn-primary">利用停止解除</button>
            </form>
        @endif
        </div>
        @endcan
        </div>
    </div>
</div>
@endsection