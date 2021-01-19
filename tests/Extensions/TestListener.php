<?php

namespace Tests\Extensions;

use Illuminate\Support\Facades\File;
use PHPUnit\Runner\{BeforeFirstTestHook, AfterLastTestHook};

final class TestListener implements BeforeFirstTestHook, AfterLastTestHook
{
	public function executeBeforeFirstTest(): void
	{
		shell_exec('php artisan migrate --env=testing');
		shell_exec('php artisan db:seed --env=testing');
	}

	public function executeAfterLastTest(): void
	{
		shell_exec('php artisan migrate:reset');
	}
}
