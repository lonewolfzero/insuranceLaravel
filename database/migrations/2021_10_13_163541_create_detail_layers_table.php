<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_detail_layers', function (Blueprint $table) {
            $table->id();
            $table->integer('layer_id');
            $table->integer('cob');
            $table->string('mindep');
            $table->double('limit_loss');
            $table->double('deductible');
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
        Schema::dropIfExists('retro_mindep_detail_layers');
    }
}
