<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$games = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->get();
        //return GameResource::collection($games->paginate())->response();
        //$games = Game::all();
        $games = Game::paginate(20);
        return $games;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = Game::create($request->post());
        return $game;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->findOrFail($id);
        try {
            $game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found']);
        }
        
        return $game;
    }

    public function showBySlug($slug)
    {
        //$game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->findOrFail($id);
        try {
            $game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->where('slug','=',$slug)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found']);
        }
        
        return $game;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $game->fill($request->post())->save();
        return $game;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json([
            'mensaje' => 'Juego eliminado'
        ]);
    }
}
