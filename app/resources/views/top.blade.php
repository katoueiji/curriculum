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
                        <input class="form-control mt-3" type="date" name="date" value="{{  request('date') }}">
                    </div>
                    
                </div>
        </form>
    </div>

    <div class="row mt-3">
        @foreach($event as $events)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <img src="{{ asset('storage/profile/' . $events['image']) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                <div>
                    @if (!Auth::user()->is_Bookmark($events->id))
                    <form action="{{ route('bookmark.store', $events->id) }}" method="post" class="d-inline">
                        @csrf
                           <button class="btn p-0 border-0 bg-transparent hover-opacity mt-2 ml-3">
                                <i class="bi bi-bookmark text-secondary" style="font-size: 1.3rem;"></i>
                            </button>
                    </form>
                    @else
                    <form action="{{ route('bookmark.destroy', $events->id) }}" method="post" class="d-inline ">
                        @csrf
                        @method('delete')
                        <button class="btn p-0 border-0 bg-transparent hover-opacity mt-2 ml-3">
                            <i class="bi bi-bookmark-fill text-primary" style="font-size: 1.3rem;"></i>
                        </button>
                    </form>
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title"><a class= "text-decoration-none text-dark" href="{{ route('event.detail', ['id' => $events->id]) }}">{{ $events->title }}</a></h5>
                    @if($events->format == 0)
                    <p class="card-text">イベント形式：zoom</p>
                    @else
                    <p class="card-text">イベント形式：YouTube</p>
                    @endif
                    <p class="card-text">日程：{{ $events->date }}</p>

                    <a href="{{ route('event.detail', ['id' => $events->id]) }}" class="btn btn-primary d-grid gap-2">イベント詳細</a>


                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

