<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructs', function (Blueprint $table) {
            $table->id('constructID');
            $table->string('constructName')->nullable();
            $table->string('constructType')->nullable();
            $table->integer('managerID');
            $table->integer('projectID');
            $table->integer('collectionID');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->char('status')->default('u');
            $table->string('imge')->nullable();
            $table->string('report')->nullable();
            $table->integer('reporterID')->nullable();
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
        Schema::dropIfExists('constructs');
    }
}
