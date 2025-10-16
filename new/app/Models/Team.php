<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, TeamSubmission> $submissions
 */
class Team extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'username', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get all submissions for this team.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(TeamSubmission::class);
    }

    /**
     * Get only confirmed submissions.
     */
    public function confirmedSubmissions(): HasMany
    {
        return $this->hasMany(TeamSubmission::class)->where('is_confirmed', true);
    }

    /**
     * Scope a query to search by name.
     */
    public function scopeSearch($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where('name', 'like', "%{$search}%");
    }

    /**
     * Get the total number of submissions.
     */
    public function getTotalSubmissionsAttribute(): int
    {
        return $this->submissions()->count();
    }

    /**
     * Get the number of confirmed submissions.
     */
    public function getConfirmedSubmissionsCountAttribute(): int
    {
        return $this->submissions()->where('is_confirmed', true)->count();
    }
}
