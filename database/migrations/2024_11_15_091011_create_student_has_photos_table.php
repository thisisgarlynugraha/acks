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
        Schema::create('student_has_photos', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('student_id');
            $table->text('url');
            $table->boolean('is_featured')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->index('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_has_photos');
    }
};
