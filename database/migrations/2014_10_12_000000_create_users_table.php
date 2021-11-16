<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->longtext('photoDB')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->Integer('countrie_id')->default(0);
            $table->longText('wallet');
            $table->string('password');
            $table->string('referral_code')->unique()->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->foreign('referred_by')->references('id')->on('users');
            $table->string('referral_admin_red_code')->unique()->nullable();
            $table->unsignedBigInteger('referred_red_by')->nullable();
            $table->foreign('referred_red_by')->references('id')->on('users');
            $table->enum('admin', [0, 1])->default(0)->comment('permite saber si un usuario es admin o no');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - inactivo, 1 - activo, 2 - eliminado');
            $table->date('expired_status')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->enum('type', ['red', 'profesional'])->nullable();

            $table->bigInteger('referred_id')->default(1)->comment('ID del usuario patrocinador');
            $table->bigInteger('binary_id')->default(1)->comment('ID del usuario binario');
            $table->enum('binary_side', ['I', 'D'])->nullable()->comment('Permite saber si esta en la derecha o izquierda en el binario');
            $table->enum('binary_side_register', ['I', 'D'])->default('I')->comment('Permite saber porque lado va a registrar a un nuevo usuario');

            $table->bigInteger('point_rank')->unsigned()->nullable();
            $table->bigInteger('rank_id')->unsigned()->default(0)->nullable();
            $table->date('date_reset_points_binary')->nullable();
            $table->tinyInteger('not_payment_binary_point_direct')->default(0)->comment('0 - paga los puntos, 1 - no paga los puntos');
            $table->string('code_email')->comment('guarda el codigo para el cambio de correo')->nullable();
            $table->dateTime('code_email_date',)->comment('fecha que se genero el codigo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
