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
        Schema::create('students_classes',function(Blueprint $table){
            $table->id();
            $table->integer('student_code');
            $table->foreign('student_code')->references('student_code')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('class_code');
            $table->foreign('class_code')->references('class_code')->on('course_classes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_classes');
    }
};
