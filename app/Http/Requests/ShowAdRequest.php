<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowAdRequest extends FormRequest
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
            "fields" => "array|in:description,images"
        ];
    }

    public function messages() {
        return [
            "fields.array" => "Опциональные поля должны быть переданы в массиве",
            "fields.in" => "Запрашиваемыми полями могут быть только описание и ссылки"
        ];
    }
}
