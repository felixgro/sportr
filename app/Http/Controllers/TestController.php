<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function dashboard()
    {
        $this->authorize('view-dashboard');

        return 'hi';
    }
}
