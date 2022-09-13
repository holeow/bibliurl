<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
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
            "Name"=> $this->Name,
            "Comment" => $this->Comment,
            "URL"=> $this->URL,
            "CreationDate" => $this->CreationDate,
            "ImgUrl" => $this->ImgUrl,
            "Folder" => $this->Folder
        ];
    }
}
