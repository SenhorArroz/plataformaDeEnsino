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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('texto');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('categrias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('texto');
            $table->integer('resposta');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categrias')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('comentariosPosts', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->unsignedBigInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('users');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('salas')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('comentariosAtividades', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->unsignedBigInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('users');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('entregasAtividades', function (Blueprint $table) {
            $table->id();
            $table->integer('resposta');
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('aluno_id')->references('id')->on('users');
            $table->unsignedBigInteger('atividade_id');
            $table->foreign('atividade_id')->references('id')->on('atividades')->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
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
