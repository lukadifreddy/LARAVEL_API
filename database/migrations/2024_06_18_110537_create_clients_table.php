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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("nom_client",45);
            $table->string("prenom_client",45);
            $table->string("phone_client",10);
            $table->string("e_mail_client",60)->nullable();
            $table->string("document",45);
            $table->unsignedBigInteger("id_adresse");
            $table->timestamps();
            $table->foreign("id_adresse")->references("id")->on("adresses")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
