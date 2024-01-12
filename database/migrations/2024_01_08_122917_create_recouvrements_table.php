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
        Schema::create('recouvrements', function (Blueprint $table) {
            $table->id();
            $table->string('ligne')->nullable();
            $table->string('idClient')->nullable();
            $table->string('libelle')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('num_facture')->nullable();
            $table->string('credit')->nullable();
            $table->string('debit')->nullable();
            $table->string('id_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recouvrements');
    }
};
