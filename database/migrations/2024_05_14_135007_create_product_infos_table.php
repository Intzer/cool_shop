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
            'title' => 'first',
            'description' => 'second',
        ]);

        DB::table('product_infos')->insert([
            'product_id' => 2,
            'title' => 'first',
            'description' => 'second',
        ]);

        DB::table('product_infos')->insert([
            'product_id' => 3,
            'title' => 'first',
            'description' => 'second',
        ]);

        DB::table('product_infos')->insert([
            'product_id' => 4,
            'title' => 'first',
            'description' => 'second',
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
