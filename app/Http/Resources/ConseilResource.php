<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Conseil
 */
class ConseilResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'anecdote' => $this->anecdote,
            'author' => $this->author,
            'location' => $this->location,
            'status' => $this->status,
            'social_links' => array_values(array_filter([
                $this->social_link_1,
                $this->social_link_2,
                $this->social_link_3,
            ])),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}

