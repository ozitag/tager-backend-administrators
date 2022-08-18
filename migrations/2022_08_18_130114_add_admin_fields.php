<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tager_administrators_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrator_id');
            $table->string('field');
            $table->longText('value');

            $table->foreign('administrator_id')->references('id')->on('tager_administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('tager_administrators_fields');

        Schema::enableForeignKeyConstraints();
    }
};
