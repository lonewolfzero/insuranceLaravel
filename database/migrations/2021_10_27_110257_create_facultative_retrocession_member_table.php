<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultativeRetrocessionMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_special_contract_facultative_retrocession_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retrocession_id');
            $table->foreign('retrocession_id', 'sc_fr_m_id_foreign')
                ->references('id')
                ->on('retro_special_contract_facultative_retrocessions')
                ->onDelete('cascade');
            $table->integer('member');
            $table->double('share');
            $table->string('rating');
            $table->string('rater');
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
        Schema::dropIfExists('retro_special_contract_facultative_retrocession_members');
    }
}
