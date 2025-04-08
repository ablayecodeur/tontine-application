<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tontine_id')->constrained();
            $table->enum('status', ['pending', 'active', 'suspended', 'rejected'])->default('pending');
            $table->integer('position')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'tontine_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
};
