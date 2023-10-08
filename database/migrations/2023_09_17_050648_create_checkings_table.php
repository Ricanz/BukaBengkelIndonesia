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
        Schema::create('checkings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('client_id');
            $table->bigInteger('employee_id');
            $table->bigInteger('sa_id')->nullable();
            $table->string('wo');
            $table->string('plat_number');
            $table->bigInteger('type_id');
            $table->string('status')->default('active');
            $table->string('checking_type')->default('standart');
            $table->string('number')->nullable();
            $table->string('saran')->nullable();
            $table->string('note')->nullable();
            $table->string('saran_post')->nullable();
            $table->string('note_post')->nullable();
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
        Schema::dropIfExists('checkings');
    }
};
