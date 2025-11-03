@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>イベント作成</h2>
        </div>
    </div>   


    <div class="row mt-3 align-items-start"> 
        <form action="{{ route('event.Create', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap">
            @csrf
            <div class="col-md-6 d-flex flex-column align-items-center">
                <input type="file" name="image" class="cursor_pointer">
                @error('image')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
                <div class="mt-3 d-flex justify-content-around gap-3 w-100">
                    <button type="submit" class="btn btn-primary w-100 fs-5">イベント作成</button>
                </div>
            </div>

            <div class="col-md-6 card-body">
                <label class="fs-6">イベント名</label>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    <input type='text' class='form-control' name='title' value="{{ old('title') }}"/>
                <label class="card-text mt-3 fs-6">イベント開催形式</label>
                @error('format')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    <select name="format" class="form-control">
                        <option value="">イベント形式を選択</option>
                        <option value="0" {{ old('format') == "0" ? 'selected' : '' }}>Zoom</option>
                        <option value="1"  {{ old('format') == "0" ? 'selected' : '' }}>YouTube</option>
                    </select>
                <label for='date'>日程と時間</label>
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="datetime-local"  class='form-control' name='date' id="datetime" value= "old('date',  \Carbon\Carbon::parse($event->datetime)->format('Y-m-d\TH:i') : '') }}"/>
                <label for='capacity'>定員人数</label>
                    @error('capacity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="number" class="form-control" name="capacity" value="{{ old('capacity') }}"/>
                <label for='type'>イベントの種類</label>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <select name="type" class="form-control">
                        <option value="">イベントの種類を選択</option>
                        <option value="0" {{ old('type') == "0" ? 'selected' : '' }}>セミナー</option>
                        <option value="1" {{ old('type') == "1" ? 'selected' : '' }}>勉強会</option>
                        <option value="2" {{ old('type') == "2" ? 'selected' : '' }}>説明会</option>
                        <option value="3" {{ old('type') == "3" ? 'selected' : '' }}>講演会</option>
                    </select>
                <label for='comment'>紹介文</label>
                    @error('comment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <textarea type='text' class='form-control' name='comment' rows="5">{{ old('comment') }}</textarea>
            </div>
        </form>
    </div>
</div>
@endsection