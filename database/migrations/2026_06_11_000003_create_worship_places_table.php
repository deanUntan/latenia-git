<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('worship_places')) return;
        Schema::create('worship_places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Masjid', 'Gereja', 'Pura', 'Vihara', 'Kelenteng', 'Lainnya'])->default('Masjid');
            $table->text('description')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->double('radius')->default(500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worship_places');
    }
};
