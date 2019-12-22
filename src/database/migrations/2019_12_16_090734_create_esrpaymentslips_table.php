<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsrpaymentslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esrpaymentslips', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('bankName');
			$table->string('bankCity');
			$table->string('bankingAccount');
			$table->string('bankingCustomerIdentification');
			$table->string('recipientName');
			$table->string('recipientAddress');
			$table->string('recipientCity');
			$table->string('payerLine1');
			$table->string('payerLine2');
			$table->string('payerLine3');
			$table->string('payerLine4');
			$table->string('amount');
			$table->string('invoiceNumber');
			$table->string('referenceNumber');
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
        Schema::dropIfExists('esrpaymentslips');
    }
}
