<?php

namespace App\Services;

use App\Models\{Event, Location, Team, Sport};

class EventService
{
	/**
	 * Handles the event store request sent to
	 * SportEventController. The $data param
	 * got already validated by the CreateEvent
	 * request class.
	 *
	 * @param  \App\Models\Sport $sport
	 * @param  array $data
	 * @return \App\Models\Event
	 */
	public function handleStoreRequest(Sport $sport, array $data)
	{
		$event = $sport->events()->create([
			'title' => $data['title'],
			'date' => $data['date'],
			'location_id' => $this->getLocationModel($data['location'])->id
		]);

		$teams = $this->getTeamModels($sport, $data['teams'])
			->mapWithKeys(fn ($team) => [$team['id'] => ['score' => $team['score']]]);

		$event->teams()->attach($teams);

		return $event;
	}

	/**
	 * Handles the event update request sent to
	 * portEventController. The $data param
	 * got already validated by the EditEvent
	 * request class.
	 *
	 * @param  \App\Models\Sport $sport
	 * @param  \App\Models\Event $event
	 * @param  array $data
	 * @return bool
	 */
	public function handleUpdateRequest(Sport $sport, Event $event, array $data)
	{
		$event->title = $data['title'] ?? $event->title;
		$event->date = $data['date'] ?? $event->date;

		if ($data['location']) {
			$location = $this->getLocationModel($data['location']);
			$event->location_id = $location->id;
		}

		if ($data['teams']) {
			$teams = $this->getTeamModels($sport, $data['teams'])
				->mapWithKeys(fn ($team) => [$team['id'] => ['score' => $team['score']]]);

			$event->teams()->sync($teams);
		}

		return $event->save();
	}

	/**
	 * Gets all ORM Instances of the given teams array.
	 * Each team needs either an 'id' key with the id of an existing team
	 * or a 'team' key with the title of a new, non existant team.
	 *
	 * @param  \App\Models\Sport $sport
	 * @param  array $teams
	 * @return \Illuminate\Support\Collection
	 */
	private function getTeamModels(Sport $sport, array $teams)
	{
		$teamModels = collect();

		foreach ($teams as $t) {
			$model = null;

			if (array_key_exists('id', $t)) {
				$model = Team::find($t['id']);
			} else if (array_key_exists('team', $t)) {
				$model = $sport->teams()->create($t['team']);
			}

			if (is_int($t['score'])) {
				$model->score = $t['score'];
			}

			$teamModels->push($model);
		}

		return $teamModels;
	}

	/**
	 * Returns the Location Model. Param can either be
	 * an integer for an existing location or an array
	 * with the necessary data to store a new location.
	 *
	 * @param  mixed $location
	 * @return \App\Models\Location
	 */
	private function getLocationModel(mixed $location)
	{
		if (is_int($location)) {
			return Location::find($location);
		}

		return Location::create($location);
	}
}
