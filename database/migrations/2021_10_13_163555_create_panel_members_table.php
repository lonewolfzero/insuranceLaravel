<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retro_mindep_panel_members', function (Blueprint $table) {
            $table->id();
            $table->integer('panel_retro_id');
            $table->string('member_retrocessionaire');
            $table->string('rating');
            $table->double('share');
            $table->timestamp('date_entry');
            $table->integer('user_entry');
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
        Schema::dropIfExists('retro_mindep_panel_members');
    }
}
