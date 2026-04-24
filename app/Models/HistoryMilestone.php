<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HistoryMilestone extends Model
{
    protected $table = 'history_milestones';

    protected $fillable = [
        'year',
        'title',
        'description',
        'image',
        'sort_order',
    ];

    // Scopes

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}
