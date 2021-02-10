<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class RecentEventController extends Controller
{
    public function __invoke(Request $request)
    {
        return Event::scored()
            ->orderBy('date', 'desc')
            ->with(['sport', 'teams', 'location'])
            ->paginate(4);
    }
}
