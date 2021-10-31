<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRetrocessionaireTypePanelRetro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retro_mindep_panel_retros', function (Blueprint $table) {
            $table->integer('retrocessionaire')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retro_mindep_panel_retros', function (Blueprint $table) {
            $table->string('retrocessionaire')->change();
        });
    }
}
