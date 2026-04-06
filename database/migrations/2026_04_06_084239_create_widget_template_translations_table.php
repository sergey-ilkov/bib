<?php

use App\Models\Language;
use App\Models\WidgetTemplate;
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
        Schema::create('widget_template_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(WidgetTemplate::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            // JSON: { "title": "...", "button_upload": "...", "error_wrong_file": "..." }
            $table->json('content');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widget_template_translations');
    }
};