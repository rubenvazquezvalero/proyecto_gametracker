<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameGameListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_game_list', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('game_list_id')
            ->constrained('game_lists')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->foreignId('game_id')
            ->constrained('games')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_game_list');
    }
}
