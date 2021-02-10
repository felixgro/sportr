<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class UpcommingEventController extends Controller
{
    public function __invoke(Request $request)
    {
        return Event::upcomming()
            ->orderBy('date', 'asc')
            ->with(['sport', 'teams', 'location'])
            ->paginate(4);
    }
}
