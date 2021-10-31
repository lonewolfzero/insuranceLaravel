<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMemberRetrocessionaireTypePanelMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retro_mindep_panel_members', function (Blueprint $table) {
            $table->integer('member_retrocessionaire')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retro_mindep_panel_members', function (Blueprint $table) {
            $table->string('member_retrocessionaire')->change();
        });
    }
}
