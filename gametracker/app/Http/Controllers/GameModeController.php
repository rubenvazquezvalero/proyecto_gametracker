<?php

namespace App\Http\Controllers;

use App\Models\GameMode;
use Illuminate\Http\Request;

class GameModeController extends Controller
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
     * @param  \App\Models\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function show(GameMode $gameMode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameMode $gameMode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameMode  $gameMode
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameMode $gameMode)
    {
        //
    }
}
