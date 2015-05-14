<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    public static function boot() {
        parent::boot();

        static::creating(function($game) {
            $game->prize_door = rand(1, 3);
        });
    }

    public function hasInitialChoice() {
        return $this->initial_choice !== 'NOT_MADE';
    }

    public function hasFinalChoice() {
        return $this->final_choice !== 'NOT_MADE';
    }
}
