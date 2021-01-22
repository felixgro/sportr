<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    /**
     * Get sport of team.
     *
     * @return App\Models\Sport
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    /**
     * Get events with team.
     *
     * @return Illuminate\Support\Collection
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
