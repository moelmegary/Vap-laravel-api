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
        Schema::create('tables', function (Blueprint $table) {
            $table->bigIncrements('table_id');
            $table->string('tableImage');
            $table->string('type');
            $table->string('description');
            $table->integer('set_num');
            $table->enum("reserved",["true","false"])->default("true");
            $table->unsignedBigInteger('cafe_id');
            $table->foreign('cafe_id')->references('cafe_id')->on('cafes')->onDelete('cascade');
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
        Schema::dropIfExists('tables');
    }
};
