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
        Schema::create('systems_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('system_id');
            $table->foreign('system_id')->references('id')->on('educational_systems')->onUpdate('cascade');
            $table->string('course_code');
            $table->foreign('course_code')->references('course_code')->on('courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems_courses');
    }
};
