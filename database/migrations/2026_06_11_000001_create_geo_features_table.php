<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('geo_features')) return;
        Schema::create('geo_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['polyline', 'polygon']);
            $table->string('color', 7)->default('#4f8ef7');
            $table->json('coordinates');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geo_features');
    }
};
