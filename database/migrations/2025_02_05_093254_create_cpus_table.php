<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cpus', function (Blueprint $table) {
            $table->id();

            $table->string('brand');
            $table->string('slug');
            $table->string('model');
            $table->unsignedTinyInteger('cores');
            $table->unsignedTinyInteger('threads');
            $table->unsignedInteger('base_clock');
            $table->unsignedInteger('boost_clock')->nullable();
            $table->string('socket');
            $table->unsignedInteger('tdp')->nullable();
            $table->unsignedInteger('price')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpus');
    }
};
