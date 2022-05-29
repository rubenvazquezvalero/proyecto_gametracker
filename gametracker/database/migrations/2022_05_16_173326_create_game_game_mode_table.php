<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameGameModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_game_mode', function (Blueprint $table) {
            $table->id();
                        
            $table->foreignId('game_id')
            ->constrained('games')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->foreignId('game_mode_id')
            ->constrained('game_modes')
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
        Schema::dropIfExists('game_game_mode');
    }
}
