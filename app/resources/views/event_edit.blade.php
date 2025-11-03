@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>イベント編集</h2>
        </div>
    </div>   

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </div>
    @endif

    <div class="row mt-3 align-items-start"> 
        <form action="{{ route('event.Edit', ['id' => $event->id]) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap">
            @csrf
            <div class="col-md-6 d-flex flex-column align-items-center">
                <img src="{{ asset('storage/profile/' . $event->image) }}"  class="img-thumbnail img-fluid rounded">
                <input type="file" id="input" name="image" class="cursor_pointer">
                @error('image')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
                <div class="mt-3 d-flex justify-content-around gap-3 w-100">
                    <a href="{{ route('event.Destroy', ['id' => $event->id]) }}" class="btn btn-danger w-100 fs-5">
                        削除
                    </a>
                    <button type="submit" class="btn btn-primary w-100 fs-5">編集完了</button>
                </div>
            </div>

            <div class="col-md-6 card-body">
                <label class="fs-6">イベント名</label>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    <input type='text' class='form-control' name='title' value="{{ $event->title }}"/>
                <label class="card-text mt-3 fs-6">イベント開催形式</label>
                @error('format')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    <select name="format" class="form-control">
                        <option value="">イベント形式を選択</option>
                        <option value="0" {{ $event->format == "0" ? 'selected' : '' }}>Zoom</option>
                        <option value="1"  {{ $event->format == "1" ? 'selected' : '' }}>YouTube</option>
                    </select>
                <label for='date'>日程</label>
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type='datetime-local' class='form-control' name='date' id='date' value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d H:i') }}"/>
                <label for='capacity'>定員人数</label>
                    @error('capacity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="number" class="form-control" name="capacity" value="{{ $event->capacity }}"/>
                <label for='type'>イベントの種類</label>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <select name="type" class="form-control">
                        <option value="">イベントの種類を選択</option>
                        <option value="0" {{ $event->type == "0" ? 'selected' : '' }}>セミナー</option>
                        <option value="1" {{ $event->type == "1" ? 'selected' : '' }}>勉強会</option>
                        <option value="2" {{ $event->type == "2" ? 'selected' : '' }}>説明会</option>
                        <option value="3" {{ $event->type == "3" ? 'selected' : '' }}>講演会</option>
                    </select>
                <label for='comment'>紹介文</label>
                    @error('comment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <textarea type='text' class='form-control' name='comment' rows="5">{{ $event->comment }}</textarea>
            </div>
        </form>
    </div>
</div>
@endsection