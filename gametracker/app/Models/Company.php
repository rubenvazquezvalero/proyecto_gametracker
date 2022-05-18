<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    public function publishedGames(){
        return $this->belongsToMany(Game::class, 'games_publishers');
    }

    public function developedGames(){
        return $this->belongsToMany(Game::class, 'games_developers');
    }
}
