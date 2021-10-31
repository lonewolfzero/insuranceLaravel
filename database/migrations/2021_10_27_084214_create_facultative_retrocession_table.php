<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultativeRetrocessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contract_facultative_retrocessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'sc_fr_id_foreign')
                ->references('id')
                ->on('retro_special_contracts')
                ->onDelete('cascade');
            $table->integer('retrocession');
            $table->double('share');
            $table->double('commission');
            $table->double('overriding_by_gross_premium');
            $table->double('overriding_by_nett_premium');
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
        Schema::dropIfExists('retro_special_contract_facultative_retrocessions');
    }
}
