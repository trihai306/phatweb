<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanyInfo extends Model
{
    protected $table = 'company_infos';

    protected $fillable = [
        'key',
        'value',
        'group',
        'sort_order',
    ];

    /**
     * Cache TTL in seconds (24 hours).
     */
    private const CACHE_TTL = 86400;

    /**
     * Cache key prefix.
     */
    private const CACHE_PREFIX = 'company_info_';

    // Static helpers

    /**
     * Retrieve the value for a given key, with optional default.
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        return Cache::remember(
            self::CACHE_PREFIX . $key,
            self::CACHE_TTL,
            function () use ($key, $default) {
                $record = static::where('key', $key)->first();

                return $record ? $record->value : $default;
            }
        );
    }

    /**
     * Store or update a company info value by key, then flush its cache entry.
     */
    public static function setValue(string $key, mixed $value): static
    {
        $record = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_PREFIX . $key);

        return $record;
    }

    // Scopes

    public function scopeByGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }
}
