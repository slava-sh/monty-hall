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
    }

    public function choose($door) {
        if (is_null($this->initial_choice)) {
            $this->initial_choice = $door;
            $this->revealed_door = collect(range(1, 3))->reject(function($door) {
                return $door === $this->prize_door ||
                       $door === $this->initial_choice;
            })->random();
        }
        else if (is_null($this->final_choice)) {
            $this->final_choice = $door;
        }
        else {
            return false;
        }
        return true;
    }
}
