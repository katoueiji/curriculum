@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="col-md-2">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="col-md-2 card-body text-center">
            <h2>プロフィール編集</h2>
        </div>
    </div>

    <div class="container mt-5">
    <form action="{{ route('profile.edit', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <label for="name">名前</label>
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                <input type="text" class="form-control mb-2" name="name" value="{{ old('name', $user->name) }}">
                
                <label for="email">メールアドレス</label>
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                <input type="text" class="form-control mb-2" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div class="col-md-6 d-flex flex-column align-items-center">
                <img src="{{ $date && $date->image ? asset('storage/profile/' . $date->image) : asset('storage/profile/default.png') }}"   class="img-thumbnail">
                <input type="file" name="image">
            </div>
        </div>

        <div class="mb-3">
            <label for="comment">コメント</label>
            <textarea type="text" class="form-control" name="comment" rows="3" value="{{ old('comment', $date->comment ?? '') }}"></textarea>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-5">更新</button>
        </div>
    </form>
</div>
</div>
@endsection