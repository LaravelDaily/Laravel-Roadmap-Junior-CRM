<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contact_name' => $this->contact_name,
            'contact_email' => $this->contact_email,
            'contact_phone_number' => $this->contact_phone_number,
            'company_name' => $this->company_name,
            'company_address' => $this->company_address,
            'company_city' => $this->company_city,
            'company_zip' => $this->company_zip,
            'company_vat' => $this->company_vat,
        ];
    }
}
