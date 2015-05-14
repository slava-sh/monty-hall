<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    public static function boot() {
        parent::boot();

        static::creating(function($game) {
            $game->prize_door = rand(1, 3);
        });
    }
}
