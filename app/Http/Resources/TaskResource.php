<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
          return [
              'id'=> $this->id,
              //'project'=> new ProjectResource($this->project),
              'title'=> $this->title,
              'slug'=>$this->slug,
              'status'=> $this->status,
              'description'=> $this->description,
              'started_at'=>$this->started_at,
              'ended_at'=> $this->ended_at,

          ];
    }
}
