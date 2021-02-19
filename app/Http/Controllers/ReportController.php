<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\CreateReport;
use App\Models\Event;
use App\Models\Report;
use Facades\App\Services\ReportService;

class ReportController extends Controller
{
    /**
     * Get all reports of given event.
     *
     * @param  \App\Models\Event
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        return response()
            ->json($event->reports);
    }

    /**
     * Store a newly created report.
     *
     * @param  \App\Http\Requests\Report\CreateReport  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReport $request, Event $event)
    {
        ReportService::forEvent($event)
            ->store($request->validated());

        return redirect()->back();
    }

    /**
     * Delete report permanently from database.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Report $report)
    {
        $this->authorize('edit-report');

        $report->delete();

        return redirect()->back();
    }
}
