<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamSubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'team_id' => $this->team_id,
            'team' => new TeamResource($this->whenLoaded('team')),
            'content' => $this->content,
            'content_preview' => $this->when($request->boolean('with_preview'), 
                fn() => \Illuminate\Support\Str::limit($this->content, 100)
            ),
            'is_confirmed' => $this->is_confirmed,
            'status' => $this->is_confirmed ? 'confirmed' : 'pending',
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
