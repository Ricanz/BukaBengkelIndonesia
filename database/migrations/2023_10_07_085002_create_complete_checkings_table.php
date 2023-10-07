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
        Schema::create('complete_checkings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sa_id')->nullable();
            $table->bigInteger('master_checking_id');
            $table->bigInteger('checking_id');
            $table->string('value');
            $table->string('type');
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
        Schema::dropIfExists('complete_checkings');
    }
};
