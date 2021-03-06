<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\CreateLocation;
use App\Http\Requests\Location\EditLocation;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Location::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('edit-event');

        return 'TODO: Create Location..';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Location\CreateLocation  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocation $request)
    {
        Location::create($request->validated());

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit-event');

        return 'TODO: Edit Event';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Location\EditLocation  $request
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(EditLocation $request, Location $location)
    {
        $location->update($request->validated());

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->authorize('delete-event');

        $location->delete();

        return redirect()->route('home');
    }
}
