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
        Schema::create('master_checkings', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('pre');
            $table->string('checking_type')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('master_checkings');
    }
};
