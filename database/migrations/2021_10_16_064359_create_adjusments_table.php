<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjusmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_adjusments', function (Blueprint $table) {
            $table->id();
            $table->integer('layer_id');
            $table->string('id_adjusment');
            $table->integer('version');
            $table->date('due_date');
            $table->double('agnpi');
            $table->double('adj_premium_rate_percentage');
            $table->double('adj_premium_rate_amount');
            $table->double('additional_premium');
            $table->double('overrider_percentage');
            $table->double('overrider_amount');
            $table->double('no_claim_bonus_percentage');
            $table->double('no_claim_bonus_amount');
            $table->double('balance_due');
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
        Schema::dropIfExists('retro_mindep_adjusments');
    }
}
