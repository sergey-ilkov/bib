<?php

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
        Schema::create('widget_types', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->unique(); // 'bank_statement_checker'
            $table->string('name');           // 'Проверка банковских выписок'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widget_types');
    }
};
