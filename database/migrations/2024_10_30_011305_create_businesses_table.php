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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->foreignId('document_type_id')->constrained();
            $table->string('document_number');
            $table->foreignId('location_id')->constrained();
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
        Schema::dropIfExists('businesses');
    }
};
