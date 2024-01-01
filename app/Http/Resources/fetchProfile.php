<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class fetchProfile extends JsonResource
{
    // this resource file created for fetch the data from (profile) table 
    // i used this for create the fetch profile API
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'age' => $this->age,
            'gender' => $this->gender,
            'height' => $this->height,
            'status' => $this->status,
            'professional_background'=> $this->professional_background    
        ];
    }
}
