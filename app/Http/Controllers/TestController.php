<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function dashboard()
    {
        $this->authorize('view-dashboard');

        return 'hi';
    }
}
