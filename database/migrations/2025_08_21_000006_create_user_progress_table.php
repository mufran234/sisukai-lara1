<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('certification_id')->constrained()->cascadeOnDelete();
            $table->integer('questions_answered')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->json('domain_scores')->nullable(); // {"People":70,"Process":55}
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_progress');
    }
};
