<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GameList  $gameList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $list = GameList::with('games')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found']);
        }

        return $list;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameList  $gameList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameList $gameList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameList  $gameList
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameList $gameList)
    {
        //
    }

    public function addGame(Request $request){
        try {
            $game = Game::findOrFail($request->game_id);
            $list = GameList::findOrFail(auth()->user()->id);
            return $game->gameLists()->sync([$list->id => ['status' => $request->status]]);
            /* return Auth::check(); */
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
