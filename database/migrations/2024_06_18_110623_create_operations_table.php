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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->decimal("montant",9,2);
            $table->string("devise",45);
            $table->decimal("commision",9,2);
            $table->string("code_operation");
            $table->string("etat",9);
            $table->datetime("date_livraison");
            $table->unsignedBigInteger("id_beneficier");
            $table->unsignedBigInteger("id_expediteur");
            $table->unsignedBigInteger("id_agent_exp");
            $table->unsignedBigInteger("id_agent_benf");
            $table->timestamps();
            $table->foreign("id_beneficier")->references("id")->on("clients")->onDelete("restrict");
            $table->foreign("id_expediteur")->references("id")->on("clients")->onDelete("restrict");
            $table->foreign("id_agent_exp")->references("id")->on("agents")->onDelete("restrict");
            $table->foreign("id_agent_benf")->references("id")->on("agents")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
