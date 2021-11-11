<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('usuario al que le pertenece la wallet');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('referred_id')->unsigned()->nullable();
            $table->foreign('referred_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreignId('inversion_id')->nullable()->constrained('inversions')->comment('inversion la cual produce esta wallet');
            $table->double('amount');
            $table->double('percentage')->nullable();
            $table->bigInteger('liquidation_id')->unsigned()->nullable();
            $table->string('descripcion');
            $table->tinyInteger('tipo_transaction')->default(0)->comment('0 - comision, 1 - retiro');
            $table->tinyInteger('status')->default(0)->comment('0 - En espera, 1 - Pagado (liquidado), 2 - Cancelado');
            $table->tinyInteger('liquidado')->default(0)->comment('0 - sin liquidar, 1 - liquidado');
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
        Schema::dropIfExists('wallets');
    }
}
