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
        Schema::create('automobiles', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->check('brand'!='');
            $table->string('model')->check('model'!='');
            $table->string('color')->check('color'!='');
            $table->string('state_number_RF')->unique()->check('state_number_RF'!='');
            $table->boolean('in_the_parking')->default(1);
            $table->unsignedBigInteger('person_id');

            $table->foreign('person_id', 'automobile_person_fk')->on('persons')->references('id');

            $table->index('person_id', 'automobile_person_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automobiles');
    }
};
