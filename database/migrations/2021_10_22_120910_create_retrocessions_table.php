<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetrocessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contract_retrocessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('special_contract_id');
            $table->foreign('special_contract_id', 'sc_r_id_foreign')
                ->references('id')
                ->on('retro_special_contracts')
                ->onDelete('cascade');
            $table->integer('retrocession');
            $table->double('share');
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
        Schema::dropIfExists('retro_special_contract_retrocessions');
    }
}
