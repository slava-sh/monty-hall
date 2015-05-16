<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeGameSlugsUniqueAndNotNull extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('games')
            ->whereNull('slug')
            ->update(['slug' => DB::raw('concat("game-", id)')]);

        // Set case-sensitive collation.
        DB::statement('ALTER TABLE games MODIFY slug VARCHAR(255) CHARACTER SET ascii COLLATE ascii_bin');
        Schema::table('games', function(Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('games', function(Blueprint $table) {
            // $table->dropUnique('slug');
            $table->string('slug')->nullable()->change();
        });
    }
}
