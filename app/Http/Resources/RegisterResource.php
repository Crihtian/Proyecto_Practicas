<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id estudiante' => $this->student_id,
            'Nombre estudiante' => $this->student->name ?? 'N/A',
            'id usuario' => $this->user_id,
            'Nombre usuario' => $this->user->name ?? 'N/A',
            'accion' => $this->action->label(),
            'creado en' => $this->created_at->format('d-m-Y H:i:s'),
            'editado en' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
