<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('weight')->default(0); // % contribution to exam
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('domains');
    }
};
