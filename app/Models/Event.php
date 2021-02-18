<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'date',
        'location_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Get sport of event.
     *
     * @return App\Models\Sport
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    /**
     * Get location of event.
     *
     * @return App\Models\Location
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get participating teams.
     *
     * @return Illuminate\Support\Collection
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->withPivot('score');
    }

    /**
     * Get reports.
     *
     * @return Illuminate\Support\Collection
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Query Scope for events with a defined score.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeScored($query)
    {
        return $query->whereHas('teams', function ($q) {
            $q->whereNotNull('score');
        });
    }

    /**
     * Query Scope for upcomming (not yet scored) Events.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcomming($query)
    {
        return $query->whereHas('teams', function ($q) {
            $q->whereNull('score');
        });
    }
}
