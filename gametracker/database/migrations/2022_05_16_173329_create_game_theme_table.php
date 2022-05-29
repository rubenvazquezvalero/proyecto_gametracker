<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_theme', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('game_id')
            ->constrained('games')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->foreignId('theme_id')
            ->constrained('themes')
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
        Schema::dropIfExists('game_theme');
    }
}
