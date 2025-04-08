<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['cash', 'mobile_money', 'bank_transfer', 'card']);
            $table->string('transaction_reference')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->dateTime('payment_date')->default(now());
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
