<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMindepTypeDetailLayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retro_mindep_detail_layers', function (Blueprint $table) {
            $table->integer('mindep')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retro_mindep_detail_layers', function (Blueprint $table) {
            $table->string('mindep')->change();
        });
    }
}
