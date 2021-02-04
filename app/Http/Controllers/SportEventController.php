<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateEvent;
use App\Http\Requests\Event\EditEvent;
use App\Models\Event;
use App\Models\Sport;
use Facades\App\Services\EventService;

class SportEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sport $sport)
    {
        return $sport->events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport)
    {
        return 'TODO: Form for creating a new Event';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Event\CreateEvent  $request
     * @param  \App\Models\Sport $sport
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEvent $request, Sport $sport)
    {
        EventService::handleStoreRequest($sport, $request->validated());

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sport $sport
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport, Event $event)
    {
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sport $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport, Event $event)
    {
        return 'TODO: Form for editing an existing event';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Event\EditEvent  $request
     * @param  \App\Models\Sport $sport
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditEvent $request, Sport $sport, Event $event)
    {
        EventService::handleUpdateRequest($sport, $event, $request->validated());

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sport $sport
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sport $sport, Event $event)
    {
        $this->authorize('delete-event');

        $event->delete();

        return redirect()->route('home');
    }
}
