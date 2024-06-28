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
        Schema::create('course_classes', function(Blueprint $table){
            $table->integer('class_code')->primary();
            $table->unsignedBigInteger('semester_id');
            $table->foreign('semester_id')->references('id')->on('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->string('course_code');
            $table->foreign('course_code')->references('course_code')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('teacher_code');
            $table->foreign('teacher_code')->references('teacher_code')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->string('education_format')->nullable();
            $table->string('description')->nullable();
            $table->string('class_type')->nullable();
            $table->string('school_day')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_classes');
    }
};
