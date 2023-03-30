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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('product');
            $table->foreignId('section_id')->constrained('sections','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('amount_collection',8,2)->nullable();
            $table->decimal('amount_commission',8,2);
            $table->decimal('discount',8,2);
            $table->string('rate_vat');
            $table->decimal('value_vat',8,2);
            $table->decimal('total',8,2);
            $table->string('status',50);
            $table->tinyInteger('status_value');
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes(); // will create column called 'deleted_at'
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
        Schema::dropIfExists('invoices');
    }
};
