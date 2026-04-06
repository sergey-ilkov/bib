<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WidgetTranslation extends Model
{
    //
    protected $fillable = [
        'widget_id',
        'language_id',
        'content'
    ];
    protected $casts = [
        'widget_id' => 'integer',
        'language_id' => 'integer',
        'content' => 'array',
    ];

    // К какому виджету принадлежит перевод
    public function widget(): BelongsTo
    {
        return $this->belongsTo(Widget::class);
    }

    // На каком языке перевод
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
