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
            'sports' => fn () => Sport::all()
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
     * Display the specified sport.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Inertia\Response
     */
    public function show(Sport $sport)
    {
        return Sport::find($sport->id)->with('teams')->first();
    }

    /**
     * Show the form for updating an existing sport.
     *
     * @param  \App\Models\Sport  $sport
     * @return \Inertia\Response
     */
    public function edit(Sport $sport)
    {
        return Inertia::render('Sport/Edit', [
            'sport' => fn () => $sport->only('id', 'title', 'icon')
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
        $this->authorize('edit-sport');

        $sport->delete();

        return redirect()->route('sports.index');
    }
}
