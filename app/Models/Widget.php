<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Widget extends Model
{
    //

    protected $fillable = [
        'site_id',
        'widget_template_id',
        'uid',
        'settings',
        'is_active'
    ];

    protected $casts = [
        'site_id' => 'integer',
        'widget_template_id' => 'integer',
        'uid' => 'string',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];
    // К какому сайту принадлежит виджет
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    // Шаблон (логика и правила), на котором основан виджет
    public function template(): BelongsTo
    {
        return $this->belongsTo(WidgetTemplate::class);
    }
    // Кастомные переводы, созданные клиентом для этого виджета
    public function clientTranslations(): HasMany
    {
        return $this->hasMany(WidgetTranslation::class);
    }
}