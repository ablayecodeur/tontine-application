<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->unsignedBigInteger('current_winner_id')->nullable()->after('max_participants');

            // Optionnel : si tu veux une contrainte de clé étrangère
           // $table->foreign('current_winner_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('tontines', function (Blueprint $table) {
            $table->dropForeign(['current_winner_id']);
            $table->dropColumn('current_winner_id');
        });
    }

};
