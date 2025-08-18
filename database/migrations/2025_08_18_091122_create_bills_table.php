<?php

use App\Models\User;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('image')->nullable();
            $table->string('origin')->nullable();
            $table->string('product_code');
            $table->date('production_date')->nullable();
            $table->string('guarantee')->nullable();
            $table->text('other_information')->nullable();
            $table->text('short_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
