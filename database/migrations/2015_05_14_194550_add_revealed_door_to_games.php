<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevealedDoorToGames extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('games', function(Blueprint $table) {
            $table->enum('revealed_door', [1, 2, 3])->nullable()->after('initial_choice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('games', function(Blueprint $table) {
            $table->dropColumn('revealed_door');
        });
    }
}
