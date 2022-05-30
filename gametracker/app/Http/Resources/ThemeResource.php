<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $game = $this->whenLoaded("game");
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'game' => new GameResource($game),
        ];
    }
}
