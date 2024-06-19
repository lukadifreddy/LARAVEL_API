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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string("name_agent",45);
            $table->string("prenom_agent",45);
            $table->string("e_mail_agent",60)->nullable();
            $table->string("phone_agent")->unique();
            $table->date("date_de_naissance");
            $table->string("fonction",45);
            $table->unsignedBigInteger("id_agence");
            $table->unsignedBigInteger("id_adresse");
            $table->timestamps();
            $table->foreign("id_agence")->references("id")->on("agences")->onDelete("restrict");
            $table->foreign("id_adresse")->references("id")->on("adresses")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
