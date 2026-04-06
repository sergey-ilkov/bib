<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WidgetTemplate extends Model
{
    //
    protected $fillable = [
        'widget_type_id',
        'name',
        'slug',
        'ocr_lang',
        'validation_rules',
        'period_rules',
        'default_language_id',
        'is_active'
    ];

    protected $casts = [
        'widget_type_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'ocr_lang' => 'string',
        'validation_rules' => 'array',
        'period_rules' => 'array',
        'default_language_id' => 'integer',
        'is_active'  => 'boolean',
    ];

    // Связь с языком по умолчанию
    public function defaultLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'default_language_id');
    }

    // Связь с типом виджета
    // public function type(): BelongsTo
    // {
    //     return $this->belongsTo(WidgetType::class, 'widget_type_id');
    // }
    public function widgetType(): BelongsTo
    {
        return $this->belongsTo(WidgetType::class);
    }
    // Все эталонные переводы этого шаблона
    public function translations(): HasMany
    {
        return $this->hasMany(WidgetTemplateTranslation::class);
    }
    // Все созданные клиентами виджеты на базе этого шаблона
    public function widgets(): HasMany
    {
        return $this->hasMany(Widget::class);
    }
}