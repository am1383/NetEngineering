<?php

use App\Enums\RentTypeEnum;
use App\Enums\StatusEnum;
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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('server_id')->constrained()->cascadeOnDelete();
            $table->string('ip', 45);
            $table->unsignedBigInteger('start_time');
            $table->unsignedBigInteger('end_time');
            $table->enum(
                'rent_type',
                array_column(RentTypeEnum::cases(), 'value'));
            $table->decimal('total_price', 10, 2);
            $table->enum(
                'status',
                array_column(StatusEnum::cases(), 'value')
            )->default(StatusEnum::PENDING);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
