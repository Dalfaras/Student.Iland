<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('study_level');
            $table->string('situation');
            $table->string('study_field');
            $table->string('year');
            $table->string('city')->nullable();
            $table->string('campus')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('visibility_students_only')->default(true);
            $table->boolean('hide_from_public_groups')->default(false);
            $table->boolean('hide_from_recommendations')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
