<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'content', 'is_confirmed', 'content_hash'];

    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    /**
     * Normalize content for consistent hashing.
     */
    public static function normalizeContent(?string $content): string
    {
        $normalized = trim((string) $content);
        // Normalize newlines
        $normalized = preg_replace("/\r\n?/", "\n", $normalized);
        
        return $normalized;
    }

    /**
     * Boot model and set up event listeners.
     */
    protected static function booted(): void
    {
        static::saving(function (self $model) {
            $model->content_hash = hash('sha256', self::normalizeContent($model->content));
        });
    }

    /**
     * Get the team that owns this submission.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Scope a query to only include confirmed submissions.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('is_confirmed', true);
    }

    /**
     * Scope a query to only include pending submissions.
     */
    public function scopePending($query)
    {
        return $query->where('is_confirmed', false);
    }

    /**
     * Scope a query to search by content or team name.
     */
    public function scopeSearch($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('content', 'like', "%{$search}%")
                ->orWhereHas('team', function ($tq) use ($search) {
                    $tq->where('name', 'like', "%{$search}%");
                });
        });
    }

    /**
     * Scope for a specific team.
     */
    public function scopeForTeam($query, int $teamId)
    {
        return $query->where('team_id', $teamId);
    }
}
