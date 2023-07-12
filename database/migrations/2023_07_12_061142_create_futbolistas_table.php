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
        Schema::create('futbolistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('ap_paterno', 60);
            $table->string('ap_materno', 60)->nullable();
            $table->string('alias', 60)->nullable();
            $table->unsignedBigInteger('no_camiseta');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('futbolistas');
    }
};
