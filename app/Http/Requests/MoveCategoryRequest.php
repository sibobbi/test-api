<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MoveCategoryRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id' => ['required', Rule::exists(Category::class, 'id')]
        ];
    }
}
