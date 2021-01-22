<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    /**
     * Get all events of sport.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get all teams of sport.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
