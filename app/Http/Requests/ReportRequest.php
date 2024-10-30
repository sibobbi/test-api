<?php

namespace App\Http\Requests;

use App\Enums\ReportType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required',Rule::in(ReportType::CSV, ReportType::JSON)]
        ];
    }
}
