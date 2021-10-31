<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_installments', function (Blueprint $table) {
            $table->id();
            $table->integer('layer_id');
            $table->date('date');
            $table->double('percentage');
            $table->timestamp('date_entry');
            $table->integer('user_entry');
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
        Schema::dropIfExists('retro_mindep_installments');
    }
}
