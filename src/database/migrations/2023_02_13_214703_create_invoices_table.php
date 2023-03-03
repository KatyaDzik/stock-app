<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('invoice_types')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
