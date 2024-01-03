<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'Name' => $this->Name,
            'Email' => $this->Email,
            'Mobile' => $this->Mobile, 
            'Password' => $this->Password,
            'reset_token' => $this->reset_token,
            'fcm_token' => $this->fcm_token,
            'video_intro' => $this->video_intro,
            'gender' => $this->gender,
            'looking_for' => $this->looking_for,
            'profession' => $this->profession,
            'relationship_status' => $this->relationship_status,
            'country' => $this->country,
            'city' => $this->city,
            'current_location' => $this->current_location,
            'home_location' => $this->home_location,
            'body_type' => $this->body_type,
            'excercise' => $this->excercise,
            'kids' => $this->kids,
            'religion' => $this->religion,
            'high_school' => $this->high_school,
            'trade_tech_school' => $this->trade_tech_school,
            'in_college' => $this->in_college,
            'ug_degree' => $this->ug_degree,
            'graduate_degree' => $this->graduate_degree,
            'in_grade_school' => $this->in_grade_school,
            'push_notification_enabled' => $this->push_notification_enabled,
        ];
    }
}
