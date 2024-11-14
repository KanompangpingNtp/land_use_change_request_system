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
        Schema::create('form_land_owner_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->string('land_owner_details_name')->nullable();
            $table->string('land_owner_details_area')->nullable();
            $table->string('land_owner_details_farm')->nullable();
            $table->string('land_owner_details_square_wa')->nullable();
            $table->string('land_owner_details_village')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_land_owner_details');
    }
};
