<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'game_modes' => GameModeResource::collection($this->whenLoaded('game_modes')),
            'developers' => CompanyResource::collection($this->whenLoaded('developers')),
            'publishers' => CompanyResource::collection($this->whenLoaded('publishers')),
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'themes' => ThemeResource::collection($this->whenLoaded('themes')),
            'platforms' => PlatformResource::collection($this->whenLoaded('platforms')),
        ];
    }
}
