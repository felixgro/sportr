<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class RecentEventController extends Controller
{

    /**
     * Get recently scored events. If an authenticated user
     * exists filter events based on favorite sports.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke()
    {
        $events = Event::query()->scored();

        if (Auth::user()) {
            $events->whereIn('sport_id', Auth::user()->favSports->pluck('id'));
        }

        return $events->orderBy('date', 'desc')
            ->with(['sport', 'teams', 'location'])
            ->paginate(4);
    }
}
