<?php

namespace Tests\Unit\Services;

use App\Models\Event;
use App\Models\User;
use Facades\App\Services\ReportService;
use Tests\TestCase;

class ReportServiceTest extends TestCase
{
	/** @test */
	public function report_service_can_store_report()
	{
		$event = Event::factory()->create();
		$user = User::factory()->create();

		$report = ReportService::forEvent($event)->withAuthor($user)->store([
			'subject' => 'Test Report',
			'description' => 'bla bla bla'
		]);

		$this->assertInstanceOf('App\Models\Report', $report);
		$this->assertDatabaseHas('reports', $report->only('id'));
	}

	/** @test */
	public function report_service_can_store_report_with_authenticated_user()
	{
		$user = $this->signIn();
		$event = Event::factory()->create();

		$report = ReportService::forEvent($event)->store([
			'subject' => 'Test Report',
			'description' => 'bla bla bla'
		]);

		$this->assertInstanceOf('App\Models\Report', $report);
		$this->assertDatabaseHas('reports', $report->only('id'));
		$this->assertEquals($report->user_id, $user->id);
	}
}
