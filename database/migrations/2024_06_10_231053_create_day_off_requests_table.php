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
        Schema::create('day_off_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_class_id");
            $table->foreign('student_class_id')->references('id')->on('students_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->date("day");
            $table->date("created_day");
            $table->time("created_time");
            $table->string("reason");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_off_requests');
    }
};
