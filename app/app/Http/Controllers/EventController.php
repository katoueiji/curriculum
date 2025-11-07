<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\CreateEvent;
use App\Http\Requests\EditEvent;
use App\Http\Requests\DeleteEvent;

class EventController extends Controller
{
    //イベント作成画面
    public function eventCreateform() {
        $user = Auth::user();
        $prevUrl = url()->previous();
        session(['profile_url' => $prevUrl]);

        return view('event_create', [
            'user' => $user,
        ]);
    }

    public function eventCreate(int $id, CreateEvent $request) {
        $user = Auth::id();
        $event = new Event;
        $url = session('profile_url');

        $file = $request->file('image');
        $file_name = $file->getClientOriginalName();
        $file->storeAs('public/profile', $file_name);  

        $colums = ['capacity', 'title', 'comment', 'date', 'format', 'type'];

        foreach ($colums as $colum) {
            $event -> $colum = $request -> $colum;
        }
        $event -> user_id = $user;
        $event -> image = $file_name;
        
        $event->save();

        return redirect($url);
    }

    //イベント編集画面
    public function eventEditform($eventId) {
        $Event = Event::findOrFail($eventId);
        $prevUrl = url()->previous();
        session(['profile_url' => $prevUrl]);

        if ($Event->user_id !== auth()->id()) {
        abort(403);
        }

        return view('event_edit', [
            'event' => $Event,
        ]);
    }

    public function eventEdit(int $id, EditEvent $request) {
        $event = new Event;
        $record = $event->findOrFail($id);
        $url = session('profile_url');

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/profile', $file_name);  

            $record -> image = $file_name;
        }

        $colums = ['capacity', 'title', 'comment', 'date', 'format'];

        foreach ($colums as $colum) {
            $record -> $colum = $request -> $colum;
        }
        
        $record->save();

        return redirect($url);
    }

    //イベント削除確認画面
    public function eventDestroyform($eventId) {
        $event = Event::findOrFail($eventId);

        if ($event->user_id !== auth()->id()) {
        abort(403);
        }
        
        return view('event_destroy', [
            'event' => $event,
        ]);
    }

    public function eventDestroy(int $id, DeleteEvent $request) {
        $event = Event::findOrFail($id);
        $event -> delete();

        $userId = Auth::id();

        return redirect()->route('event.main', [
            'id' => $userId,
        ]);
    }
}
