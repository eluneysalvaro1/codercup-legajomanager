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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('nombre')->after('id');
            $table->string('apellido')->after('nombre');
            $table->string('laboratorio')->after('email');
            $table->string('role')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido', 'laboratorio', 'role']);
            $table->string('name')->after('id');
        });
    }
};
