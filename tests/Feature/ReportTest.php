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
		$this->get(route('reports.index'))
			->assertRedirect(route('login'));

		$this->post(route('reports.store'))
			->assertRedirect(route('login'));
	}

	/** @test */
	public function users_can_create_reports()
	{
		$user = $this->signIn();

		$event = Event::factory()->create();

		$this->post(route('reports.store', $event), [
			'subject' => 'Test Report',
			'description' => 'Lorem ipsum',
		])->assertRedirect();

		$report = Report::where('subject', 'Test Report')->first();

		$this->assertInstanceOf('App\Models\Report', $report);
		$this->assertEquals($report->user->id, $user->id);
		$this->assertEquals($report->event->id, $event->id);
	}
}
