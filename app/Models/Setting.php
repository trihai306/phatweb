<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Cache TTL in seconds (24 hours).
     */
    private const CACHE_TTL = 86400;

    /**
     * Cache key prefix.
     */
    private const CACHE_PREFIX = 'setting_';

    // Static helpers

    /**
     * Retrieve a setting value by key, with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
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
     * Store or update a setting value by key, then flush its cache entry.
     */
    public static function set(string $key, mixed $value): static
    {
        $record = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_PREFIX . $key);

        return $record;
    }
}
