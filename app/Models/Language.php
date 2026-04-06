<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',

    ];

    protected $casts = [
        'name' => 'string',
        'code' => 'string',
    ];

    // Получить все шаблоны виджетов на этот язык
    public function widgetTemplates(): HasMany
    {
        return $this->hasMany(WidgetTemplate::class, 'default_language_id');
    }

    // Получить все переводы шаблонов на этот язык
    public function templateTranslations(): HasMany
    {
        return $this->hasMany(WidgetTemplateTranslation::class);
    }
}