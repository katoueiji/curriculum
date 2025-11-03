@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex text-canter">
        <div class="p-2 flex-fill">
            <h2>トップ画面</h2>
        </div>
    </div>  
    <div class="text-center mt-5">
            <div class="card-body mt-5">
                <form action="{{ route('event.all') }}" method="get">
                    <button type="submit" class="btn btn-primary w-25 fs-5 btn-lg">全イベント一覧</button>
                </form>
            </div>
            <div class="card-body mt-5">
                <form action="{{ route('user.all') }}" method="get">
                    <button type="submit" class="btn btn-primary w-25 fs-5 btn-lg">全ユーザー一覧</button>
                </form>
            </div>
            <div class="card-body mt-5">
                <form action="{{ route('join.user') }}" method="get">
                    <button type="submit" class="btn btn-primary w-25 fs-5 btn-lg">参加ユーザー覧</button>
                </form>
            </div>
    </div>
</div>
@endsection