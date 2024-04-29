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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('role');

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('role_name', length: 120);
            $table->integer('responsibility_id')->unsigned()->nullable();
            $table->integer('treatment_id')->unsigned()->nullable();
            $table->unique(['role_name', 'responsibility_id']);
        });

        Schema::dropIfExists('responsibility');

        Schema::create('responsibility', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('enclosure_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->unique(['enclosure_id','role_id']);
        });

        Schema::table('responsibility', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('id')->on('enclosure')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign('role_id')
            ->references('id')->on('enclosure')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('role', function (Blueprint $table) {
            $table->foreign('responsibility_id')
            ->references('id')->on('responsibility')->nullOnDelete();
            $table->foreign('treatment_id')
            ->references('id')->on('treatment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
