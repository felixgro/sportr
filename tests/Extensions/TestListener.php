<?php

namespace Tests\Extensions;

use Illuminate\Support\Facades\File;
use PHPUnit\Runner\{BeforeFirstTestHook, AfterLastTestHook};

final class TestListener implements BeforeFirstTestHook, AfterLastTestHook
{
	/**
	 * Migrate & seed testing database before running.
	 *
	 */
	public function executeBeforeFirstTest(): void
	{
		shell_exec('php artisan migrate --env=testing');
		shell_exec('php artisan db:seed --env=testing');
	}

	/**
	 * Reset testing database when done.
	 *
	 */
	public function executeAfterLastTest(): void
	{
		shell_exec('php artisan migrate:reset');
	}
}
