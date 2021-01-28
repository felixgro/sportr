<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\{CreateTeam, EditTeam};
use App\Models\{Sport, Team};
use Inertia\Inertia;

class SportTeamController extends Controller
{
    /**
     * Show all teams of a given sport.
     *
     * @param  \App\Models\Sport $sport
     * @return \Inertia\Response
     */
    public function index(Sport $sport)
    {
        return $sport->teams;
    }

    /**
     * Show the form for creating a team.
     *
     * @param  \App\Models\Sport $sport
     * @return \Inertia\Response
     */
    public function create(Sport $sport)
    {
        $this->authorize('edit-team');

        return Inertia::render('Team/Create', [
            'sport' => $sport
        ]);
    }

    /**
     * Store a newly created team in storage.
     *
     * @param  \App\Http\Requests\Team\CreateTeam  $request
     * @param  \App\Models\Sport $sport
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTeam $request, Sport $sport)
    {
        $sport->teams()->create($request->validated());

        return redirect()->route('sports.show', $sport);
    }

    /**
     * Display the specified team.
     *
     * @param  \App\Models\Sport $sport
     * @param  \App\Models\Team $team
     * @return \Inertia\Response
     */
    public function show(Sport $sport, Team $team)
    {
        return $team;
    }

    /**
     * Show the form for updating an existing team.
     *
     * @param  \App\Models\Sport $sport
     * @param  \App\Models\Team $team
     * @return \Inertia\Response
     */
    public function edit(Sport $sport, Team $team)
    {
        $this->authorize('edit-team');

        return Inertia::render('Team/Edit', [
            'team' => $team
        ]);
    }

    /**
     * Update an existing team.
     *
     * @param  \App\Http\Requests\Team\EditTeam  $request
     * @param  \App\Models\Sport  $sport
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditTeam $request, Sport $sport, Team $team)
    {
        $team->update($request->validated());

        return redirect()->route('sports.show', $sport);
    }

    /**
     * Remove the specified team from storage along with all
     * of its Events and Scores.
     *
     * @param  \App\Models\Sport  $sport
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sport $sport, Team $team)
    {
        $this->authorize('edit-team');

        $team->delete();

        return redirect()->route('sports.show', $sport);
    }
}
