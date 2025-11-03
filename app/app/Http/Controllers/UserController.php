<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\userDate;
use App\Http\Requests\profileEdit;

class UserController extends Controller
{
    //プロフィール編集
    public function profileEditform($userId) {
        $user = User::findOrFail($userId);
        $date = $user->userDate;

        if ($user->id !== auth()->id()) {
        abort(403);
        }

        return view('profile_edit', [
            'user' => $user,
            'date' => $date,
        ]);
    }

    public function profileEdit(profileEdit $request) {
        $user = Auth::user();
        $date = $user->userDate ?? $user->userDate()->create([]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/profile', $file_name);

            $date->image = $file_name;    
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $date->comment = $request->comment;

        $user->save();
        $date->save();

        $userId = Auth::id();
        $date = $user->userDate;
        $main = count($user->Event->where('user_id', '=', $userId));
        $join = count($user->Event_user->map(fn($Eu) => $Eu->Event));

        return redirect()->route('user.profile', [
            'id' => $userId,
            'date' => $date,
            'main' => $main,
            'join' => $join,
        ]);
    }

    //退会・ログアウト画面
    public function userEdit($userId) {
        $user = User::findOrfail($userId);
        $date = $user->userDate;

        if ($user->id !== auth()->id()) {
        abort(403);
        }

        return view('user_edit', [
            'user' => $user,
            'date' => $date,
        ]);
    }

    public function delete(Request $request) {
        $user = Auth::user();

        $user ->delete();

        return redirect('/login');
    }

    //ブックマーク一覧
    public function bookmark_event() {
        $events = \Auth::user()->bookmark_event()->orderBy('created_at', 'desc')->paginate(20);

        return view('bookmark', [
            'event' => $events,
        ]);
    }

    //主催イベント一覧
    public function eventMainform(int $userID) {
        $user = User::findOrFail($userID);
        $events = $user->Event->where('user_id', '=', $userID)->toArray();

        return view('event_main', [
            'user' => $user,
            'events' => $events,
        ]);
    }
    
    //参加イベント一覧
    public function userJoinform(int $userID) {
        $user = User::findOrFail($userID);
        $events = $user->Event_user->map(fn($Eu) => $Eu->Event)->toArray();
    
        return view('user_join', [
            'user' => $user,
            'events' => $events,
        ]);
    }
}
