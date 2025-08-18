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
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique(); // Tên file
            $table->string('path'); // Đường dẫn file
            $table->string('format'); // jpg, png, webp, ...
            $table->bigInteger('size')->nullable(); // bytes
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
