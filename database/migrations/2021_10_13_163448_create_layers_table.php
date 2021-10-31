<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_layers', function (Blueprint $table) {
            $table->id();
            $table->integer('main_contract_id');
            $table->string('id_layer');
            $table->string('our_contract');
            $table->string('kind_of_treaty');
            $table->integer('type_coverage');
            $table->double('mindep_100');
            $table->double('share');
            $table->double('mindep_retro');
            $table->double('withholding_tax');
            $table->double('limit_loss');
            $table->double('deductible');
            $table->double('aggregate');
            $table->double('adj_rate');
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
        Schema::dropIfExists('retro_mindep_layers');
    }
}
