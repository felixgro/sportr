<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'user_id'
    ];

    /**
     * Get related event.
     *
     * @return \App\Models\Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get related user.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
