<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Report;
use Tests\TestCase;

class ReportTest extends TestCase
{
	/** @test */
	public function guests_cannot_interact_with_reports()
	{
		$event = Event::factory()->create();

		$this->get(route('reports.index', $event))
			->assertRedirect(route('login'));

		$this->post(route('reports.store', $event))
			->assertRedirect(route('login'));
	}

	/** @test */
	public function users_can_create_reports()
	{
		$user = $this->signIn();

		$event = Event::factory()->create();

		$this->post(route('reports.store', $event), [
			'subject' => 'Test Report bla',
			'description' => 'Lorem ipsum',
		])->assertRedirect();

		$report = Report::where('subject', 'Test Report bla')->first();

		$this->assertInstanceOf('App\Models\Report', $report);
		$this->assertEquals($report->user->id, $user->id);
		$this->assertEquals($report->event->id, $event->id);
	}

	/** @test */
	public function mods_can_delete_reports()
	{
		$this->signIn('moderator');

		$report = Report::factory()->create();

		$this->delete(route('reports.destroy', [$report->event, $report]))
			->assertRedirect();

		$this->assertDatabaseMissing('reports', $report->only('id'));
	}
}
