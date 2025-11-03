@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="p-2 flex-fill">
            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
        </div>
        <div class="p-2 flex-fill">
            <h2>ブックマーク一覧</h2>
        </div>
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