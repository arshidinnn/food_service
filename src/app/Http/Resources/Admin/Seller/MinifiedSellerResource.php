<?php

namespace App\Http\Resources\Admin\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Seller*/
class MinifiedSellerResource extends JsonResource
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
            'name' => $this->name,
            'bin' => $this->bin,
            'email' => $this->user->email,
            'reg_number' => $this->reg_number,
            'temporary_password' => $this->user->temporary_password,
         ];
    }

    public static $wrap = null;
}
