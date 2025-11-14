<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function bkm_product(Request $request) {


        if ( $request->input('bkm_product') == 0 ) {
            Bookmark::create([
            'event_id' => $request->input('event_id'),
            'user_id' => auth()->user()->id,
        ]);

        } elseif ( $request->input('bkm_product') == 1 ) {
            Bookmark::where('event_id', "=", $request->input('event_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
        }
        $newStatus = $request->input('bkm_product') == 0 ? 1 : 0;
        return $newStatus;
    }
}
