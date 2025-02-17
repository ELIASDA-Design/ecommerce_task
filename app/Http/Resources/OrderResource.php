<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::where("id", $this->user_id)->first();
        return [
            "id" => $this->id,
            "total" => $this->total,
            "products" => $this->products,
            "address" => $this->address,
            "track_code" => $this->track_code,
            "username" => $user->name,
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
