<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteSportController extends Controller
{
    /**
     * Get all favorite sport ids of authenticated user.
     *
     * @return array
     */
    public function index()
    {
        return Auth::user()->favSports->pluck('id');
    }

    /**
     * Store favorite sports for authenticated user.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Auth::user()
            ->favSports()
            ->attach(array_values($request->all()));

        return redirect()->route('home');
    }

    /**
     * Update favorite sports for authenticated user.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Auth::user()
            ->favSports()
            ->sync(array_values($request->all()));

        return redirect()->route('home');
    }
}
