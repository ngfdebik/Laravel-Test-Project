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
            $table->string('stateNumberRF')->unique()->check('stateNumberRF'!='');
            $table->boolean('inTheParking')->default(1);
            $table->unsignedBigInteger('personId');

            $table->foreign('personId', 'automobile_person_fk')->on('persons')->references('id');

            $table->index('personId', 'automobile_person_idx');
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
