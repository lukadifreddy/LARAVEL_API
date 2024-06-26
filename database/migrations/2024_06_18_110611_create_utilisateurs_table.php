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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string("nom_utilisateur",45)->unique();
            $table->string("password",256);
            $table->unsignedBigInteger("id_externe")->nullable()->unique();
            $table->unsignedBigInteger("id_agent")->nullable()->unique();
            $table->timestamps();
            $table->foreign("id_externe")->references("id")->on("externes")->onDelete("restrict");
            $table->foreign("id_agent")->references("id")->on("agents")->onDelete("restrict");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
