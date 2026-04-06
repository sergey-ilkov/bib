<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'domen',
        'upload_url',
        'device_script',
        'is_blocked',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'domen' => 'string',
        'upload_url' => 'string',
        'device_script' => 'boolean',
        'is_blocked' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function widgets(): HasMany
    {
        return $this->hasMany(Widget::class);
    }
}