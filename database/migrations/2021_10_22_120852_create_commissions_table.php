<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contract_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('special_contract_id');
            $table->foreign('special_contract_id', 'sc_c_id_foreign')
                ->references('id')
                ->on('retro_special_contracts')
                ->onDelete('cascade');
            $table->integer('cob');
            $table->double('commission');
            $table->double('overriding_by_gross_premium');
            $table->double('overriding_by_nett_premium');
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
        Schema::dropIfExists('retro_special_contract_commissions');
    }
}
