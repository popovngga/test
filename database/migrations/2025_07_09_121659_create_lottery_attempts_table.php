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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('number');
            $table->string('result');
            $table->decimal('amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lottery_attempts');
    }
};
