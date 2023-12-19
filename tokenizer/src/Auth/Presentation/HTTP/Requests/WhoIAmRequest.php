<?php

namespace Src\Auth\Presentation\HTTP\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Shared\Infrastructure\Laravel\Rules\MobileRule;

class WhoIAmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
        ];
    }
}
