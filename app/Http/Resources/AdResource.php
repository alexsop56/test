<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $main_image = null;

        if(is_array($this->images) && count($this->images)) {
            $main_image = $this->images[0];
        }

        $is_description_in_fields = $request->fields && in_array("description", $request->fields);
        $is_images_in_fields = $request->fields && in_array("images", $request->fields);

        return [
            "id" => $this->id,
            "title" => $this->title,
            "image" => $main_image,
            "price" => $this->price,
            "description" => $this->when($is_description_in_fields, $this->description),
            "images" => $this->when($is_images_in_fields, $this->images),
        ];
    }
}
