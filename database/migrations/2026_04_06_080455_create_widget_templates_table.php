<?php

use App\Models\Language;
use App\Models\WidgetType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('widget_templates', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(WidgetType::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('country_code', 2); // mx
            $table->string('ocr_lang', 5);

            $table->json('validation_rules');
            $table->json('period_rules');

            // Явно указываем таблицу, так как имя колонки нестандартное
            $table->foreignIdFor(Language::class, 'default_language_id')->constrained('languages')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widget_templates');
    }
};