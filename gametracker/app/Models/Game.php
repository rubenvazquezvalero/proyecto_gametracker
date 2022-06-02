<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    
    public function gameLists(){
        return $this->belongsToMany(GameList::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function game_modes(){
        return $this->belongsToMany(GameMode::class);
    }

    public function platforms(){
        return $this->belongsToMany(Platform::class)->withPivot('release_date');
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function themes(){
        return $this->belongsToMany(Theme::class);
    }

    public function publishers(){
        return $this->belongsToMany(Company::class, 'game_publisher');
    }

    public function developers(){
        return $this->belongsToMany(Company::class, 'game_developer');
    }
}
