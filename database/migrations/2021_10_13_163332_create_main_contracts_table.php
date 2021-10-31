<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_main_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('main_contract');
            $table->integer('u_w_year');
            $table->integer('cob');
            $table->longText('contract_description');
            $table->double('egnpi');
            $table->integer('currency');
            $table->date('period_from');
            $table->date('period_to');
            $table->double('roe');
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
        Schema::dropIfExists('retro_mindep_main_contracts');
    }
}
