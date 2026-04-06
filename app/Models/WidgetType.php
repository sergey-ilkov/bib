<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WidgetType extends Model
{
    //

    protected $fillable = [
        'slug',
        'name',

    ];

    protected $casts = [
        'slug' => 'string',
        'name' => 'string',
    ];

    // Все  созданные шаблоны на базе этого типа
    public function templates(): HasMany
    {
        return $this->hasMany(WidgetTemplate::class);
    }
}
