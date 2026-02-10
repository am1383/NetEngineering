<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gpus', function (Blueprint $table) {
            $table->id();

            $table->string('brand');
            $table->string('slug');
            $table->string('model');
            $table->unsignedInteger('vram');
            $table->string('chipset');
            $table->unsignedInteger('power')->nullable();
            $table->unsignedInteger('price')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gpus');
    }
};
