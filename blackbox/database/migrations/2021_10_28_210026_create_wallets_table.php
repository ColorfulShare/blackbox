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
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreignId('inversion_id')->nullable()->constrained('inversions');
            //$table->foreignId('liquidation_id')->nullable()->constrained('liquidations');   
            $table->double('amount');
            $table->double('percentage')->nullable();
            $table->string('descripcion');
            $table->tinyInteger('status')->default(0)->comment('0 - En espera, 1 - Pagado (liquidado), 2 - Cancelado');
            //$table->tinyInteger('type')->default(0)->comment('0 - Utilidad, 1 - Cartera, 2 - Comisiones, 3 - bono red nivel 1, 4 - bono red nivel 2, 3 bono red nivel 3');
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
