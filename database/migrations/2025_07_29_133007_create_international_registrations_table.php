<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('international_registrations', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email')->unique();
        $table->string('country_code'); // e.g. +251
        $table->string('phone');
        $table->string('course_level'); // dropdown
        $table->string('student_type'); //  Highschool student
        $table->string('registration_type'); //  Tuition / Boarding / Both
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('international_registrations');
    }
};
