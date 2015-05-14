<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    public static function boot() {
        parent::boot();

        static::creating(function($game) {
            $game->prize_door = rand(1, 3);
        });
    }

    public function choose($door) {
        if (is_null($this->initial_choice)) {
            $this->initial_choice = $door;
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
