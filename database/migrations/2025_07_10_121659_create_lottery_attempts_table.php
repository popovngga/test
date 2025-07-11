<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lottery_attempts', function (Blueprint $table) {
            $table->id();
            $table->uuid('token_id');
            $table->unsignedInteger('number');
            $table->string('result');
            $table->decimal('amount');
            $table->timestamps();

            $table->foreign('token_id')->references('id')->on('tokens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lottery_attempts');
    }
};
