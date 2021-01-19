<?php

namespace Tests;

use Tests\Setup\ApplicationSetup;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use ApplicationSetup;
}
