<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property array $old_data
 * @property array $new_data
 * @property boolean $rejected
 * @property User $user
 * @property bool $moderator
 */
class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'old_data'   => $this->old_data,
            'new_data'   => $this->new_data,
            'rejected'   => (bool) $this->rejected,
            'user'       => [
                'id'     => $this->user->id,
                'name'   => $this->user->name,
            ],
            'moderator'  => $this->when($this->moderator, $this->moderator),
        ];
    }
}
