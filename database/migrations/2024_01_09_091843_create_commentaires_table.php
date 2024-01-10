<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('ligne');
            $table->string('idClient');
            $table->string('libelle');
            $table->string('email');
            $table->string('telephone');
            $table->string('num_facture');
            $table->string('credit');
            $table->string('debit');
            $table->string('message');
            $table->string('id_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
