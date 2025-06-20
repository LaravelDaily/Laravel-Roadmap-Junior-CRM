<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'company_name',
        'company_address',
        'company_city',
        'company_zip',
        'company_vat',
    ];

    public function companyName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
