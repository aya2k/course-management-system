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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('trainer_id')->index();
            $table->string('name');
            //$table->string('image')->nullable();
            $table->text('desc');
            $table->time('duration');
            $table->decimal('price', 8, 3);
            $table->integer('num_students')->comment('number of students enrolled in')->nullable();
            $table->boolean('is_avaliable')->default(true);
            $table->timestamps();

            $table->foreign('trainer_id')
                ->references('id')
                ->on('trainers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
