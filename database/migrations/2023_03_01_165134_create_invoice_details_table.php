<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('invoice_number')->constrained('invoices','invoice_number')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('invoice_number',50);
            $table->foreignId('invoice_id')->constrained('invoices','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('product', 50);
            $table->string('section', 999);
            $table->string('status', 50);
            $table->integer('status_value');
            $table->date('payment_date')->nullable();
            $table->text('note')->nullable();
            $table->string('user',300);
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
        Schema::dropIfExists('invoice_details');
    }
};
