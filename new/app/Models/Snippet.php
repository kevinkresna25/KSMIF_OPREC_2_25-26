<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'correct_order'];

    protected $casts = [
        'correct_order' => 'integer',
    ];

    /**
     * Scope to order by correct order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('correct_order', 'asc');
    }

    /**
     * Get all snippets in correct order as array.
     */
    public static function getCorrectOrder(): array
    {
        return static::ordered()->pluck('content')->toArray();
    }

    /**
     * Get combined HTML in correct order.
     */
    public static function getCombinedHtml(): string
    {
        return static::ordered()->pluck('content')->implode('');
    }

    /**
     * Scope to search by content.
     */
    public function scopeSearch($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where('content', 'like', "%{$search}%");
    }
}
