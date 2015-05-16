<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    protected $casts = [
        'prize_door'     => 'integer',
        'initial_choice' => 'integer',
        'revealed_door'  => 'integer',
        'final_choice'   => 'integer',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function($game) {
            $game->prize_door = rand(1, 3);
        });

        static::created(function($game) {
            $game->slug = \Hashids::encode($game->id);
            $game->save();
        });
    }

    public function getRouteKey() {
        return $this->slug;
    }

    public static function findBySlug($slug) {
        return static::whereSlug($slug)->first();
    }

    public function scopeFinished($query) {
        return $query->whereNotNull('final_choice');
    }

    public function scopeNotFinished($query) {
        return $query->whereNull('final_choice');
    }

    public function scopeSwitched($query) {
        return $query->finished()->whereRaw('final_choice != initial_choice');
    }

    public function scopeStayed($query) {
        return $query->finished()->whereRaw('final_choice = initial_choice');
    }

    public function scopeWins($query) {
        return $query->finished()->whereRaw('final_choice = prize_door');
    }

    public function scopeLosses($query) {
        return $query->finished()->whereRaw('final_choice != prize_door');
    }

    /*
     * Does not validate the input.
     */
    public function choose($door) {
        $door = (int) $door;
        if (is_null($this->initial_choice)) {
            $this->initial_choice = $door;
            $this->revealed_door = collect(range(1, 3))->filter(function($door) {
                return $door !== $this->prize_door &&
                       $door !== $this->initial_choice;
            })->random();
        }
        else if (is_null($this->final_choice)) {
            $this->final_choice = $door;
        }
    }
}
