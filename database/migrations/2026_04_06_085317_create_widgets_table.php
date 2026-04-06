<?php

use App\Models\Site;
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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();

            // Привязка к сайту клиента
            $table->foreignIdFor(Site::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            // Какой шаблон (логику) использует этот виджет
            $table->foreignIdFor(WidgetTemplate::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            // Публичный идентификатор для вставки скрипта: <script src=".../?uid=abc-123">
            $table->string('uid')->unique();
            // Кастомизация стилей (цвета, отступы, радиусы) в JSON
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};