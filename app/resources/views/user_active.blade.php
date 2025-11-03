@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>本当に利用停止しますか？</h2>
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
            <form action="{{ route('user.active', ['id' => $user->id]) }}" method="post">
            @csrf
                <button type="submit" class="btn btn-primary btn-lg w-50 fs-3 mt-4">解除する</button>
            </form>
        </div>
    </div>
</div>
@endsection