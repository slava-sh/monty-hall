<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertEnumsToTinyints extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('games', function(Blueprint $table) {
            $table->tinyInteger('prize_door_int'    )->after('prize_door');
            $table->tinyInteger('initial_choice_int')->nullable()->after('initial_choice');
            $table->tinyInteger('revealed_door_int' )->nullable()->after('revealed_door');
            $table->tinyInteger('final_choice_int'  )->nullable()->after('final_choice');
        });
        for ($i = 1; $i <= 3; ++$i) {
            DB::table('games')->where('prize_door',     $i)->update(['prize_door_int'     => $i]);
            DB::table('games')->where('initial_choice', $i)->update(['initial_choice_int' => $i]);
            DB::table('games')->where('revealed_door',  $i)->update(['revealed_door_int'  => $i]);
            DB::table('games')->where('final_choice',   $i)->update(['final_choice_int'   => $i]);
        }
        DB::statement('ALTER TABLE games DROP prize_door, DROP initial_choice, DROP revealed_door, DROP final_choice');
        Schema::table('games', function(Blueprint $table) {
            $table->renameColumn('prize_door_int',     'prize_door');
            $table->renameColumn('initial_choice_int', 'initial_choice');
            $table->renameColumn('revealed_door_int',  'revealed_door');
            $table->renameColumn('final_choice_int',   'final_choice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('games', function(Blueprint $table) {
            $table->enum('prize_door_enum'    , [1, 2, 3])->after('prize_door');
            $table->enum('revealed_door_enum' , [1, 2, 3])->nullable()->after('revealed_door');
            $table->enum('initial_choice_enum', [1, 2, 3, 'NOT_MADE'])->default('NOT_MADE')->after('initial_choice');
            $table->enum('final_choice_enum'  , [1, 2, 3, 'NOT_MADE'])->default('NOT_MADE')->after('final_choice');
        });
        for ($i = 1; $i <= 3; ++$i) {
            DB::table('games')->where('prize_door',     $i)->update(['prize_door_enum'     => $i]);
            DB::table('games')->where('initial_choice', $i)->update(['initial_choice_enum' => $i]);
            DB::table('games')->where('revealed_door',  $i)->update(['revealed_door_enum'  => $i]);
            DB::table('games')->where('final_choice',   $i)->update(['final_choice_enum'   => $i]);
        }
        DB::statement('ALTER TABLE games DROP prize_door, DROP initial_choice, DROP revealed_door, DROP final_choice');
        $query = <<<END
            ALTER TABLE games
                CHANGE prize_door_enum     prize_door     ENUM('1', '2', '3')             NOT NULL,
                CHANGE initial_choice_enum initial_choice ENUM('1', '2', '3', 'NOT_MADE') NOT NULL DEFAULT 'NOT_MADE',
                CHANGE revealed_door_enum  revealed_door  ENUM('1', '2', '3')                 NULL DEFAULT NULL ,
                CHANGE final_choice_enum   final_choice   ENUM('1', '2', '3', 'NOT_MADE') NOT NULL DEFAULT 'NOT_MADE';
END;
        DB::statement($query);
    }
}
