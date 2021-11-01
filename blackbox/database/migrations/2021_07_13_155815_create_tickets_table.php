<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status', [0, 1])->default(0)->comment('0 - Abierto, 1 - Cerrado');
            $table->longtext('issue');
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
        Schema::dropIfExists('tickets');
    }
}
