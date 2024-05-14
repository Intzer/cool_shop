<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('purchases_count')->default(0);
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();

            $table->integer('count')->nullable();
            $table->string('sku')->nullable();
        });

        DB::table('product_infos')->insert([
            'product_id' => 1,
            'title' => 'CS 1.6 game activation key',
            'description' => 'You can easy activate the game by this key.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_infos');
    }
};
