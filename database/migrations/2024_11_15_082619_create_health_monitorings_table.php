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
        Schema::create('health_monitorings', function (Blueprint $table) {
            $table->id();
            $table->uuid('student_id');
            $table->date('check_date');
            $table->integer('weight');
            $table->integer('height');
            $table->integer('temperature');
            $table->integer('spo2');
            $table->integer('heart_rate');
            $table->timestamps();

            $table->index('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_monitorings');
    }
};
