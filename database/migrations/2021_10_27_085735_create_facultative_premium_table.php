<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultativePremiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contract_facultative_premiums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'sc_fp_id_foreign')
                ->references('id')
                ->on('retro_special_contracts')
                ->onDelete('cascade');
            $table->date('production_date');
            $table->date('document_date');
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
        Schema::dropIfExists('retro_special_contract_facultative_premiums');
    }
}
