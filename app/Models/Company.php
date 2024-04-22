<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Company extends Model
{
    use HasFactory, UsesTenantConnection, HasUlids;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
