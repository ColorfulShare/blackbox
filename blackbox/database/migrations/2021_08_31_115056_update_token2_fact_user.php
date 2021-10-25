<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToken2FactUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('token_google')->commet('guarda el token de la doble autenticacion')->nullable();
            $table->enum('activar_2fact', [0, 1])->default(0)->comment('activa o desactiva la doble autenticacion de un usuario');
            $table->text('QR_code')->commet('guarda el codigo QR del usuario')->nullable();
            //$table->string('two_factor_code_email')->nullable();
            //$table->dateTime('two_factor_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['token_google', 'activar_2fact', 'QR_code']);
        });
    }
}
