<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_admin')) {
				//$table->boolean('is_admin')->default('false')->after('password');
				$table->boolean('is_admin')->default(0)->after('password');
            }
        });
		
		Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'tier')) {
                $table->enum('tier', ['free', 'pro'])->default('free')->after('is_admin');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
            }
        });
		Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'tier')) {
                $table->dropColumn('tier');
            }
        });
    }
};
