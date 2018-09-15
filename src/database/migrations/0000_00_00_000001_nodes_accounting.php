<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesAccounting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Módulo de Parámetros Contables
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->enum('type', ['over_sales','over_profit'])->nullable();
            $table->integer('percentage')->nullable();
            $table->timestamps();
        });
        Schema::create('transaction_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->integer('code')->nullable();
            $table->timestamps();
        });
        Schema::create('concepts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->nullable()->default(0);
            $table->string('code')->nullable();
            $table->enum('type', ['asset','liability','equity','income','expense'])->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concept_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
            $table->foreign('concept_id')->references('id')->on('concepts')->onDelete('cascade');
        });
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->string('reference')->nullable();
            $table->timestamps();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
        // Módulo de Contabilidad
        Schema::create('place_accountability', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('transaction_code')->nullable();
            $table->integer('pending_payment_id')->nullable();
            $table->string('name')->nullable();
            $table->enum('type', ['credit','debit'])->nullable();
            $table->string('reference')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->decimal('exchange', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('real_amount', 10, 2)->nullable();
            $table->decimal('credit', 10, 2)->nullable();
            $table->decimal('debit', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->decimal('currency_balance', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('place_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_from_id')->unsigned();
            $table->integer('place_to_id')->unsigned();
            $table->integer('account_from_id')->unsigned();
            $table->integer('account_to_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
            $table->foreign('place_from_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('place_to_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('account_from_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('account_to_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('reference')->nullable();
            $table->integer('place_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('sale_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('reference')->nullable();
            $table->integer('place_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('partner_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('accounts_payable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('reference')->nullable();
            $table->enum('status', ['holding','paid','unpaid'])->nullable()->default('holding');
            $table->integer('place_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->date('due_date')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('accounts_receivable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('reference')->nullable();
            $table->enum('status', ['holding','paid','unpaid'])->nullable()->default('holding');
            $table->integer('place_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->date('due_date')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->integer('sale_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        /* Módulo de Capital */
        if(config('accounting.partners')){
            Schema::create('partners', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->integer('account_id')->unsigned();
                $table->decimal('return_percentage', 10, 2)->nullable()->default(10);
                $table->decimal('capital', 10, 2)->nullable()->default(0);
                $table->timestamps();
                $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            });
            /*Schema::create('partner_details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->enum('status', ['holding','finished'])->nullable()->default('holding');
                $table->integer('currency_id')->unsigned();
                $table->integer('product_id')->unsigned();
                $table->integer('partner_transport_id')->nullable();
                $table->integer('sale_item_id')->nullable();
                $table->integer('initial_quantity')->nullable();
                $table->integer('quantity')->nullable();
                $table->decimal('investment', 10, 2)->nullable()->default(0);
                $table->decimal('transport_investment', 10, 2)->nullable()->default(0);
                $table->decimal('return', 10, 2)->nullable()->default(0);
                $table->decimal('transport_return', 10, 2)->nullable()->default(0);
                $table->decimal('profit', 10, 2)->nullable()->default(0);
                $table->boolean('paid')->nullable()->default(0);
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('partners')->onDelete('cascade');
                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });*/
            Schema::create('partner_movements', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->integer('place_id')->unsigned();
                $table->string('name')->nullable();
                $table->enum('type', ['move_in','move_out'])->nullable();
                $table->integer('currency_id')->unsigned();
                $table->decimal('amount', 10, 2)->nullable()->default(0);
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('partners')->onDelete('cascade');
                $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Módulo de Capital
        Schema::dropIfExists('partner_movements');
        Schema::dropIfExists('partner_details');
        Schema::dropIfExists('partners');
        // Módulo de Contabilidad
        Schema::dropIfExists('accounts_payable');
        Schema::dropIfExists('accounts_receivable');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('place_movements');
        Schema::dropIfExists('place_accountability');
        // Módulo de Parámetros Contables
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('concepts');
        Schema::dropIfExists('transaction_codes');
        Schema::dropIfExists('taxes');
}
