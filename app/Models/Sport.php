<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon'
    ];

    /**
     * Stores a new sport along with an icon.
     * The icon should be included in the attr array
     * either as an Illuminate\Http\File or Illuminate\Http\UploadedFile
     * with a key of 'icon'.
     *
     * @param array $attr
     * @return \App\Models\Sport
     */
    public static function createWithIcon($attr)
    {
        $iconName = 'sport_' . now()->format('YmdHisu') . '.svg';

        $attr['icon'] = Storage::putFileAs('icons', $attr['icon'], $iconName);

        return Sport::create($attr);
    }

    /**
     * Updates an existing sport.
     *
     * @param array $attr
     * @return bool
     */
    public function updateWithOptionalIcon($attr)
    {
        if (! $attr['icon']) {
            unset($attr['icon']);
        } else {
            // delete old icon
            if (Storage::exists($this->icon)) {
                Storage::delete($this->icon);
            }

            // store new icon
            $iconName = 'sport_' . now()->format('YmdHisu') . '.svg';
            $attr['icon'] = Storage::putFileAs('icons', $attr['icon'], $iconName);
        }

        return $this->update($attr);
    }

    /**
     * Get all events of sport.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get all teams of sport.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}