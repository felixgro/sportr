<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchSuggestionController extends Controller
{
    /**
     * Gets all search results based on a client's
     * query q received via GET request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $query = $this->assignBooleanOperators($request->get('q'));

        return response()->json([
            'events' => $this->getSearchResultsFor('events', $query),
            'sports' => $this->getSearchResultsFor('sports', $query),
            'teams'  => $this->getSearchResultsFor('teams', $query)
        ]);
    }

    /**
     * Assigns boolean operators for searching using a
     * fulltext index in boolean mode by wraping each word
     * in between + and *.
     *
     * @param  string  $searchTerm
     * @return string
     */
    private function assignBooleanOperators(string $searchTerm)
    {
        return implode('', array_map(fn ($e) => "+{$e}*", explode(' ', $searchTerm)));
    }

    /**
     * Sends fulltext search request to mysql and returns an
     * array of all correlating results.
     *
     * Since the table property gets directly injected in the raw
     * sql query it should never contain any sort of user input. Only call
     * this method by directly passing a plain string as a table parameter.
     * f.e: $this->getSearchResultsFor('events', $query)
     * NOT: $this->getSearchResultsFor($userDefinedVar, $query)
     *
     * @param  string $table
     * @param  string $query
     * @param  string $col
     * @return array
     */
    private function getSearchResultsFor(string $table, string $query)
    {
        return DB::select(
            "SELECT id, title FROM {$table} WHERE MATCH(title) AGAINST(? IN BOOLEAN MODE)",
            [$query]
        );
    }
}
