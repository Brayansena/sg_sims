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
        Schema::create('dispositivos', function (Blueprint $table) {

            $table->string('marca');
            $table->string('descripcion');
            $table->id();
            $table->string('tipoDispositivo');
            $table->string('serial');
            $table->unsignedBigInteger('id_puntoVenta');
            $table->foreign('id_puntoVenta')->references('id')->on('punto_ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('estado');
            $table->string('cedulaResponsable')->nullable();
            $table->string('responsable')->nullable();
            $table->string('fechaAsignacion')->nullable();
            $table->string('numeroActa')->nullable();
            $table->string('mac')->nullable();
            $table->string('imei')->nullable();
            $table->string('capacidad')->nullable();
            $table->text('observacion')->nullable();

            $table->unsignedBigInteger('id_userCreador')->default(2);
            $table->foreign('id_userCreador')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('dispositivos');
    }
};
