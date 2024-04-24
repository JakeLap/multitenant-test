<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
    use HasFactory, UsesTenantConnection, HasUlids;

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function scopeFilterForUser(Builder $query, User $user): Builder
    {
        return $query->when( !$user->is_admin, function (Builder $query) use ($user) {
            return $query->whereHas('users', function (Builder $query) use ($user) {
                $query->where('users.id', $user->id);
            });
        });
    }
}
