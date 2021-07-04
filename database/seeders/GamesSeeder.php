<?php

use App\Models\Game;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GamesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        for ($i = 1; $i <= 300; ++$i) {
            $game = Game::create([]);
            if (static::chance(4, 5)) {
                $game->choose(rand(1, 3));
                if (static::chance(4, 5)) {
                    $door = collect(range(1, 3))->filter(function($door) use ($game) {
                        return $door !== $game->revealed_door;
                    })->random();
                    $game->choose($door);
                }
            }
            $game->save();
            echo $game . PHP_EOL;
        }
    }

    protected static function chance($chance, $total_chance) {
        return rand(1, $total_chance) <= $chance;
    }
}
