<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $this->authorize('view-dashboard');

        return 'Dashboard here..';
    }
}
