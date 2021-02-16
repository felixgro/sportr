<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchSuggestionController extends Controller
{
    /**
     * tba.
     *
     * @return string
     */
    public function __invoke(Request $request)
    {
        $q = $request->get('q');

        $query = '';

        foreach (explode(' ', $q) as $word) {
            if (!empty($query)) {
                $query .= ' ';
            }

            $query .= "+{$word}*";
        }

        $events = DB::select(
            'SELECT id, title FROM events WHERE MATCH(title) AGAINST(? IN BOOLEAN MODE)',
            [$query]
        );

        $sports = DB::select(
            'SELECT id, title FROM sports WHERE MATCH(title) AGAINST(? IN BOOLEAN MODE)',
            [$query]
        );

        $teams = DB::select(
            'SELECT id, title FROM teams WHERE MATCH(title) AGAINST(? IN BOOLEAN MODE)',
            [$query]
        );

        return response()->json([
            'events' => $events,
            'sports' => $sports,
            'teams' => $teams
        ]);
    }
}
