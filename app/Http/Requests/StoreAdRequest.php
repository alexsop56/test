<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
            "title" => "required|max:200",
            "description" => "max:1000",
            "images" => "array|max:3",
            "price" => "numeric"
        ];
    }

    public function messages() {
        return [
            "title.required" => "Введите название",
            "title.max" => "Максимальная длина названия 200 символов",
            "description.max" => "Максимальная длина описания 1000 символов",
            "images.array" => "Ожидается массив ссылок изображений",
            "images.max" => "Максимальное количество ссылок изображений 3",
            "price.numeric" => "Цена должна быть указана числом"
        ];
    }
}
