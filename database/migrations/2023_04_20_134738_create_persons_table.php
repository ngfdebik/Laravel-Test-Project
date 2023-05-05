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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->check('name'!='');
            $table->string('gender')->check('gender'!='');
            $table->string('telephone')->unique()->check('telephone'!='');
            $table->string('address')->nullable();
            
            $table->softDeletes();
        });
        
        DB::statement('ALTER TABLE persons ADD CONSTRAINT MINIMO CHECK (LENGTH(name) >= 3)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
