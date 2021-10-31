<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpreadingCobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_spreading_cobs', function (Blueprint $table) {
            $table->id();
            $table->integer('main_contract_id');
            $table->string('id_spreading_cob');
            $table->integer('detail_cob');
            $table->double('percentage');
            $table->string('type');
            $table->string('koc');
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
        Schema::dropIfExists('retro_mindep_spreading_cobs');
    }
}
