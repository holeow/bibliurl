<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "ID"=> $this->ID,
            "Name" => $this->Name,
            "ImgUrl"=> $this->ImgUrl,
            "Container"=> $this->Container,
            "WebUser"=> $this->WebUser,

            "links"=> [
                "Parent Folder" => $this->Container == null ? null : route('folders.show',$this->Container),
                "Tags" => route("folders.tags",$this->ID)
            ]

        ];
    }
}
