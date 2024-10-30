<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SortCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sort_number' => ['required', 'integer'],
        ];
    }
}
