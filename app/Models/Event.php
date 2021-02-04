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
            ->as('score')
            ->withPivot('score');
    }
}
