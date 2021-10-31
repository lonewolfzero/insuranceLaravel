<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_name')->unique();
            $table->integer('u_w_year');
            $table->integer('koc');
            $table->integer('cob');
            $table->integer('currency');
            $table->date('period_from');
            $table->date('period_to');
            $table->string('type');
            $table->double('max_liability');
            $table->string('source_amount')->nullable();
            $table->double('commission')->nullable();
            $table->double('overriding_by_gross_premium')->nullable();
            $table->double('overriding_by_nett_premium')->nullable();
            $table->double('total_share')->nullable();
            $table->integer('user_entry');
            $table->date('date_entry');
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
        Schema::dropIfExists('retro_special_contracts');
    }
}
