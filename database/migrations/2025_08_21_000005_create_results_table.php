<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('certification_id')->constrained()->cascadeOnDelete();
			$table->integer('total_questions');
            $table->integer('correct_answers');
            $table->decimal('score', 5, 2);
            $table->integer('total');
            $table->integer('time_taken')->nullable(); // in minutes
            $table->json('breakdown')->nullable(); // per-domain scores
			$table->json('weakest_topics')->nullable(); // store topic info as JSON
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('results');
    }
};
