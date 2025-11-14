@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <form action="{{ route('user.profile', ['id' => $user]) }}" method="get">
                <button type="submit" class="btn btn-primary">プロフィール</button>
            </form>
        </div>
        <div class="p-2 flex-fill">
            <h2>トップ画面</h2>
        </div>
    </div>
        <div class="mt-4">

          <form action="{{ route('sort') }}" method="GET">

        @csrf
            <div class="row">
                    <p>検索条件を入力（一部空欄でも検索可能）</p>
                    <div class="col-sm-4">
                        <input class="form-control" placeholder="キーワードを入力" type="text" name="word" value="{{ request('word') }}" >
                    </div>
                    <div class="col-sm-4">
                        <select name="format" class="form-control">
                            <option value="">イベント形式を選択</option>
                            <option value="0" {{ request('format') == "0" ? 'selected' : '' }}>Zoom</option>
                            <option value="1"  {{ request('format') == "1" ? 'selected' : '' }}>YouTube</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control mt-3" type="datetime-local" name="date" value="{{  request('date') }}">
                    </div>
                    <div class="col-sm-4">
                        <select name="type" class="form-control mt-3">
                            <option value="">イベントの種類を選択</option>
                            <option value="0" {{ request('type') == "0" ? 'selected' : '' }}>セミナー</option>
                            <option value="1"  {{ request('type') == "1" ? 'selected' : '' }}>勉強会</option>
                            <option value="2"  {{ request('type') == "1" ? 'selected' : '' }}>説明会</option>
                            <option value="3"  {{ request('type') == "1" ? 'selected' : '' }}>講演会</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                    <button type="reset" class="btn btn-secondary mt-3">リセット</button>
                    </div>
                </div>
        </form>
    </div>

    <div class="row mt-3">
        @foreach ($events as $event)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class=m-2>
                    @if($event->type == 0)
                    <span class="card-text bg-primary text-white rounded-4 pl-2 pr-2">セミナー</span>
                    @elseif($event->type == 1)
                    <span class="card-text bg-success text-white rounded-4 pl-2 pr-2">勉強会</span>
                    @elseif($event->type == 2)
                    <span class="card-text bg-warning text-white rounded-4 pl-2 pr-2">説明会</span>
                    @elseif($event->type == 3)
                    <span class="card-text bg-secondary text-white rounded-4 pl-2 pr-2">講演会</span>
                @endif
                </div>
                <img src="{{ asset('storage/profile/' . $event['image']) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                <div>
                    @if(auth()->user())
                        @if(isset($product->bkm_products[1]))
                            <button class="send btn p-0 border-0 bg-transparent hover-opacity mt-2 ml-3" event_id="{{ $event->id }}" bkm_product="1">
                                <i class="bi bi-bookmark text-secondary" style="font-size: 1.3rem;"></i>
                            </button>
                        @else
                            <button class="send btn p-0 border-0 bg-transparent hover-opacity mt-2 ml-3" event_id="{{ $event->id }}" bkm_product="0">
                                <i class="bi bi-bookmark-fill text-primary" style="font-size: 1.3rem;"></i>
                            </button>
                        @endif
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title"><a class= "text-decoration-none text-dark" href="{{ route('event.detail', ['id' => $event->id]) }}">{{ $event->title }}</a></h5>
                    @if($event->format == 0)
                    <p class="card-text">イベント形式：zoom</p>
                    @else
                    <p class="card-text">イベント形式：YouTube</p>
                    @endif
                    <p class="card-text">日程：{{ $event->date }}</p>

                    <a href="{{ route('event.detail', ['id' => $event->id]) }}" class="btn btn-primary d-grid gap-2">イベント詳細</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="mt-4 d-flex justify-content-end">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection

