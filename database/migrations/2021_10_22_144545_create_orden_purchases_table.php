<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('package_id')->nullable()->constrained('packages');
            $table->integer('amount');
            $table->decimal('fee');
            $table->string('hash')->nullable();
            $table->string('comprobante')->nullable();
            $table->enum('type_payment', ['USDT_TRC20', 'USDT_ERC20', 'BTC'])->nullable();
            $table->enum('status', [0, 1, 2, 3])->default(0)->comment('0 - En Espera, 1 - finalizado, 2 - Aprobado, 3 Rechazada');
            $table->boolean('genero_comision')->default(1);
            $table->enum('activacion', ['real', 'manual'])->default('real');
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
        Schema::dropIfExists('orden_purchases');
    }
}
