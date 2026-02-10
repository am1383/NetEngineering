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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cpu_id')->constrained();
            $table->string('slug');
            $table->string('server_name');
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('gpu_id')->constrained();
            $table->foreignId('ram_id')->constrained();
            $table->integer('storage');
            $table->string('os');
            $table->decimal('price_per_hour', 10, 2);
            $table->decimal('price_per_day', 10, 2);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
