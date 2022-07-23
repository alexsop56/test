<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "page" => "required|integer",
        ];
    }

    public function messages() {
        return [
            "page.required" => "Укажите страницу",
            "page.integer" => "Страница должна быть указана числом",
        ];
    }
}
