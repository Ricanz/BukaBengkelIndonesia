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
        Schema::create('standart_checkings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checking_id');
            $table->string('km')->nullable();
            $table->string('high')->nullable();
            $table->string('low')->nullable();
            $table->string('suhu')->nullable();
            $table->string('saran')->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('standart_checkings');
    }
};
