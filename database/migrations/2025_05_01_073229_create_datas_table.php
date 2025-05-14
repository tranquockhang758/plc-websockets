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
        Schema::create('datas', function (Blueprint $table) {
            $table->id();
            $table->boolean('Conveyor_IN')->nullable();
            $table->boolean('Conveyor_OUT')->nullable();
            $table->boolean('CYLINDER_GREEN')->nullable();
            $table->boolean('CYLINDER_BLUE')->nullable();
            $table->boolean('CYLINDER_YELLOW')->nullable();
            $table->boolean('GREEN_LIGHT')->nullable();
            $table->boolean('YELLOW_LIGHT')->nullable();
            $table->boolean('RED_LIGHT')->nullable();
            $table->boolean('SIREN')->nullable();
            $table->integer('Setting_Prod_GR_in_box')->nullable();
            $table->integer('Setting_Prod_BL_in_box')->nullable();
            $table->integer('Setting_Prod_YE_in_box')->nullable();
            $table->integer('Setting_Box_GR')->nullable();
            $table->integer('Setting_Box_BL')->nullable();
            $table->integer('Setting_Box_YE')->nullable();
            $table->integer('Prod_GR')->nullable();
            $table->integer('Prod_BL')->nullable();
            $table->integer('Prod_YE')->nullable();
            $table->integer('Box_GR')->nullable();
            $table->integer('Box_BL')->nullable();
            $table->integer('Box_YE')->nullable();
            $table->integer('Prod_GR_in_box')->nullable();
            $table->integer('Prod_BL_in_box')->nullable();
            $table->integer('Prod_YE_in_box')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datas');
    }
};
