<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ksas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('open_hours');
            $table->text('important_details');
            $table->double('longitude');
            $table->double('latitude');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ksas');
    }
};
