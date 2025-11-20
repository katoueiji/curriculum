<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $eventId = $request->input('event_id');

        $bookmark = $user->is_Bookmark()->where('event_id', $eventId)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        } else {
            $user->is_Bookmark()->create(['event_id' => $eventId]);
            return response()->json(['status' => 'added']);
        }
    }
}
