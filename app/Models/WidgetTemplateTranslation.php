<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WidgetTemplateTranslation extends Model
{
    //

    protected $fillable = [
        'widget_template_id',
        'language_id',
        'content'
    ];
    protected $casts = [
        'widget_template_id' => 'integer',
        'language_id' => 'integer',
        'content' => 'array',
    ];

    // К какому шаблону относится перевод
    public function template(): BelongsTo
    {
        return $this->belongsTo(WidgetTemplate::class);
    }
    // На каком языке перевод
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
