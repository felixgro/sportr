<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\Ajax\SearchSuggestionController;
use App\Models\Event;
use Tests\TestCase;

class SearchSuggestionControllerTest extends TestCase
{
	/** @test */
	public function search_controller_can_assign_boolean_operators()
	{
		$withBooleanOps = $this->callMethod(
			new SearchSuggestionController(),
			'assignBooleanOperators',
			['firstWord secondWord']
		);

		$this->assertEquals('+firstWord*+secondWord*', $withBooleanOps);
	}

	/** @test */
	public function search_controller_can_get_query_results()
	{
		$event = Event::factory()->create([
			'title' => 'NFL'
		]);

		$results = $this->callMethod(
			new SearchSuggestionController(),
			'getSearchResultsFor',
			['events', '+NFL*', 'title']
		);

		$this->assertIsArray($results);
		$this->assertEquals($results[0]->id, $event->id);
		$this->assertEquals($results[0]->title, $event->title);
	}
}
