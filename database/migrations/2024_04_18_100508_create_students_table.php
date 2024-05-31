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
        Schema::create('students', function (Blueprint $table){
            $table->integer('student_code')->primary();
            $table->string('name');
            $table->date('birth_date');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('home_town')->nullable();
            $table->string('email')->unique();
            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->integer('student_course');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
