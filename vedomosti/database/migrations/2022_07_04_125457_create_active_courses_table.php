<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_student');
            $table->foreign('id_student')
                ->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('id_course');
            $table->foreign('id_course')
                ->references('id')->on('courses')->onDelete('cascade');
            $table->json('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_courses');
    }
};
