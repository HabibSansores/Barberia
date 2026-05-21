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
        // 1. Eliminar la tabla duplicada/fantasma 'appointments' si existe
        Schema::dropIfExists('appointments');

        // 2. Modificar la tabla 'citas' para agregar llaves foráneas híbridas
        Schema::table('citas', function (Blueprint $table) {
            $table->foreignId('cliente_id')
                ->after('id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('barber_id')
                ->after('cliente_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('service_id')
                ->after('barber_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->dropForeign(['barber_id']);
            $table->dropForeign(['service_id']);
            
            $table->dropColumn(['cliente_id', 'barber_id', 'service_id']);
        });

        // NOTA: No volvemos a crear 'appointments' aquí porque se asume que
        // la migración original de appointments se encargaría de recrearla si se hace un refresh total.
    }
};
