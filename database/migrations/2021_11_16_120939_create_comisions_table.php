<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('amount');
            $table->tinyInteger('level')->default(0)->comment('0 - normal, 1 -  admin de red');
            $table->tinyInteger('status')->default(0)->comment('0 - pendiente , 1 - pagada, 2 - Cancelada');
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
        Schema::dropIfExists('comisions');
    }
}
