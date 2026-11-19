<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'marks' => $this->marks,
            'profile_image' => $this->profile_image,
            'course_id' => $this->course_id,

            'course' => $this->whenLoaded('courseDetails', function () {
                return [
                    'id' => $this->courseDetails->id,
                    'name' => $this->courseDetails->name
                ];
            }),
        ];
    }
}
