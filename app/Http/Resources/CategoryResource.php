<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categories' => CategoryResource::collection($this->categories->sortByDesc('sort_number')),
            'products' => ProductResource::collection($this->products->sortByDesc('sort_number')),
        ];
    }
}
