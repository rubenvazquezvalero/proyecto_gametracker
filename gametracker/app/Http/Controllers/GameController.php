<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //$game = Game::create($request->post());
        $game = new Game();
        $game->title = $request->title;
        $game->slug = $request->slug;
        $game->description = $request->description;
        
        try {
            $game->save();

            // Obtener el siguiente id
            /* $id=DB::select("SHOW TABLE STATUS LIKE 'games'");
            $game->id = $id[0]->Auto_increment; */
    
            foreach ($request->genres as $genre) {
                $game->genres()->attach($genre['id']);
            }
            foreach ($request->themes as $theme) {
                $game->themes()->attach($theme['id']);
            }
            foreach ($request->developers as $developer) {
                $game->developers()->attach($developer['id']);
            }
            foreach ($request->publishers as $publisher) {
                $game->publishers()->attach($publisher['id']);
            }
            foreach ($request->modes as $mode) {
                $game->game_modes()->attach($mode['id']);
            }
            foreach ($request->platforms as $platform) {
                $game->platforms()->attach([$platform['id'] => ['release_date' => $platform['release_date']]]);
            }
        } catch (\Throwable $th) {
            if($th instanceof \PDOException )
            {
                //return response()->view('errors.500', [], 500);
                return response()->json(['error' => 'invalid'], 401);
            }
            return $th;
        }

        //$game->save();
        
        //return $game;
        return response()->json(['success' => 'success'], 200);
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
        //return GameResource::collection($game->paginate())->response();
    }

    public function showBySlug($slug)
    {
        //$game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->findOrFail($id);
        try {
            $game = Game::with(['genres','themes','platforms','developers','publishers','game_modes'])->where('slug','=',$slug)->firstOrFail();
            //$game = Game::with(['genres','themes','platforms','developers','publishers','game_modes']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Not found']);
        }
        
        return $game;
        //return GameResource::collection($game->get())->where('slug','=',$slug)->firstOrFail();
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
