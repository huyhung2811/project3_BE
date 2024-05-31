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
        Schema::create('attendance_times', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('student_attendance_id');
            $table->foreign('student_attendance_id')->references('id')->on('student_attendances')->onUpdate('cascade')->onDelete('cascade');
            $table->date('day')->nullable();
            $table->time('time')->nullable();
            $table->string('bluetooth_address')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_times');
    }
};
