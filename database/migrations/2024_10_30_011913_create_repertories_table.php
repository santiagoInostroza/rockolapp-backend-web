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
        Schema::create('repertories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('song_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->timestamp('time_start_available')->useCurrent();
            $table->timestamp('time_end_available')->default('2099-12-31 23:59:59');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repertories');
    }
};
