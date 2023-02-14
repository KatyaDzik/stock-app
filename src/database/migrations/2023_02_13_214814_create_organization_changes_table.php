<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_changes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('organization_id')->unsigned();
            $table->bigInteger('editor_id')->unsigned();
            $table->foreign('editor_id')->references('id')->on('users');
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
        Schema::dropIfExists('organization_changes');
    }
}
