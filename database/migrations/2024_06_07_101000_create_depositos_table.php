<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira para a tabela planos
            $table->foreignId('plano_id')->constrained()->onDelete('cascade');

            // Dados do depósito semanal
            $table->integer('semana');
            $table->decimal('valor', 8, 2);
            $table->date('data');

            // Marca se o depósito foi feito (true = feito, false = pendente)
            $table->boolean('feito')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('depositos');
    }
};
