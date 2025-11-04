<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use App\Event_user;
use App\Reports;
use App\Http\Requests\EventJoin;
use App\Http\Requests\EventReport;

class EventParticipationController extends Controller
{
    // イベント参加フォーム
    public function eventJoinform($eventId) {
        $event = Event::findOrFail($eventId);
        $userId = Auth::id();
        $currentCount = Event_user::where('event_id', $eventId)->count();
        $capacity = $event->capacity;

        if (Event_user::where('user_id', $userId)->where('event_id', $eventId)->exists()) {
            $Event_user = 1;
        } elseif ($currentCount >= $capacity) {
            $Event_user = 2;
        } else {
            $Event_user = 0;
        }

        return view('event_join', [
            'event' => $event,
            'Event_user' => $Event_user,
        ]);
    }

    // イベント参加保存
    public function eventJoin(int $id, EventJoin $request) {
        $event_user = new Event_user;
        $event = Event::findOrFail($id);
        $user = Auth::id();

        $event_user->event_id = $event->id;
        $event_user->user_id = $user;
        $event_user->comment = $request->comment;
        $event_user->step = 1;

        $event_user->save();

        return redirect('/');
    }

    // イベント参加取り消しフォーム
    public function userCancelform(int $id) {
        $user = Auth::user();
        $event = Event::findOrFail($id);

        return view('user_cancel', [
            'user' => $user,
            'event' => $event,
        ]);
    }

    // イベント参加取り消し
    public function userCancel(int $id, Request $request) {
        $user = Auth::user();
        Event_user::where('event_id', $id)->where('user_id', $user->id)->delete();

        return redirect()->route('user.join', ['id' => $user->id]);
    }

    //イベント報告
    public function eventReportform($eventId) {
        $event = Event::findOrFail($eventId);
        $eventid = $event->id;
        $userId = Auth::id();

        return view('event_report',[
            'event' => $event,
        ]);
    }

    public function eventReport(int $id, EventReport $request) {
        $reports = new Reports;
        $event = Event::findOrFail($id);
        $user = Auth::id();

        $reports->event_id = $event->id;
        $reports->user_id = $user;
        $reports->comment = $request->comment;

        $reports->save();

        return redirect('/');    
    }
}
