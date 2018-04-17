<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdObjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bd_objetos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('path')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('size')->nullable();
            $table->integer('tema_id')->unsigned();
            $table->foreign('tema_id')->references('id')->on('bd_temas')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bd_objetos');
    }
}