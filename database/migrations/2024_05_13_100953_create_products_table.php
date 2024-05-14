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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable();
            $table->string('sku')->nullable();
            $table->integer('count')->nullable();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('products');
        });

        DB::table('products')->insert([
            'sku' => '123456',
            'count' => 52,
        ]);

        DB::table('products')->insert([
            'sku' => '123457',
            'count' => 25,
        ]);

        DB::table('products')->insert([
            'sku' => '123458',
            'count' => 85,
        ]);

        DB::table('products')->insert([
            'sku' => '123459',
            'count' => 58,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
