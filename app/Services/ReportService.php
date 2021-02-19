<?php

namespace App\Services;

use App\Models\{Event, User};
use Illuminate\Support\Facades\Auth;

class ReportService
{
	/**
	 * Related event.
	 *
	 * @var \App\Models\Event
	 */
	protected $event;

	/**
	 * Related user as author
	 *
	 * @var \App\Models\User
	 */
	protected $author;

	/**
	 * Writes and stores a new report in the database.
	 *
	 * @param  \App\Models\Event $event
	 * @param  \App\Models\User $author
	 * @param  array $attr
	 * @return \App\Models\Report
	 */
	public function store(array $attr)
	{
		if (!$this->author && Auth::check()) {
			$this->author = Auth::user();
		}

		return $this->event->reports()->create([
			'subject' => $attr['subject'],
			'description' => $attr['description'],
			'user_id' => $this->author->id
		]);
	}

	/**
	 * Defines related event.
	 *
	 * @param \App\Models\Event $event
	 * @return ReportService
	 */
	public function forEvent(Event $event)
	{
		$this->event = $event;

		return $this;
	}

	/**
	 * Defines related author.
	 *
	 * @param \App\Models\User $user
	 * @return ReportService
	 */
	public function withAuthor(User $author)
	{
		$this->author = $author;

		return $this;
	}
}
