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
        Schema::create('project_technology', function (Blueprint $table) {

            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
                  ->references('id')
                  ->on('technologies')
                  ->onDelete('cascade');

            
            $table->unsignedBigInteger('project_id');

            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');

            
            //creazione Primary Key (non è indispensabile)
            $table->primary(['technology_id', 'project_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
