<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sport\CreateSport;
use App\Http\Requests\Sport\EditSport;
use App\Models\Sport;
use Inertia\Inertia;

class SportController extends Controller
{
    /**
     * Show all Sports.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Sport/Index', [
            'sports' => fn () => Sport::all()->append('route')
        ]);
    }

    /**
     * Show the form for creating a sport.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $this->authorize('edit-sport');

        return Inertia::render('Sport/Create');
    }

    /**
     * Store a newly created sport in storage.
     *
     * @param  \App\Http\Requests\Sport\CreateSport  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSport $request)
    {
        Sport::createWithIcon($request->validated());

        return redirect()->route('sports.index');
    }

    /**
     * Display the specified sport alogn
     * with its related events and teams.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Inertia\Response
     */
    public function show(Sport $sport)
    {
        return Inertia::render('Sport/Show', [
            'sport' => $sport->append('route')
                ->load(['teams', 'events'])
        ]);
    }

    /**
     * Show the form for updating an existing sport.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Inertia\Response
     */
    public function edit(Sport $sport)
    {
        $this->authorize('edit-sport');

        return Inertia::render('Sport/Edit', [
            'sport' => fn () => $sport->only('id', 'title', 'icon', 'route'),
            'totalTeams' => fn () => $sport->teams->count(),
            'totalEvents' => fn () => $sport->events->count()
        ]);
    }

    /**
     * Update given sport in storage.
     *
     * @param  \App\Http\Requests\Sport\EditSport  $request
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditSport $request, Sport $sport)
    {
        $data = $request->validated();

        $sport->updateWithOptionalIcon($data);

        return redirect()->route('sports.index');
    }

    /**
     * Remove the specified sport from storage.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sport $sport)
    {
        $this->authorize('delete-sport');

        $sport->delete();

        return redirect()->route('sports.index');
    }
}
