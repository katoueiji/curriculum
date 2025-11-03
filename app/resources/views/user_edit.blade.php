@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>ログアウト・退会</h2>
        </div>
    </div>

    <div class="row mt-3 justify-content-between text-center" style="height: 400px;"> 
        <div class="col-md-6 card-body d-flex flex-column justify-content-center">
            <form action="{{ route('logout') }}" method="POST">
                <p class="fs-5">ログアウトしますか？</p>
                @csrf
                <button type="submit" class="btn btn-primary btn-lg w-50 fs-3 mt-4">ログアウト</button>
            </form>
        </div>            

        <div class="col-md-6 card-body d-flex flex-column justify-content-center">
            <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="POST">
                <p class="fs-5">退会しますか？</p>
                @csrf
                <button type="submit" class="btn btn-danger btn-lg w-50 fs-3 mt-4">退会</button>
            </form>
        </div>
    </div>
</div>
@endsection