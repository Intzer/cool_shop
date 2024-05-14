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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('parent_id')->nullable();
            $table->string('name');
            $table->integer('child_count')->default(0);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_id');
            $table->foreignId('category_id');
        });

        DB::table('categories')->insert([
            [
               'name' => 'Games',
               'parent_id' => null,
               'child_count' => 1,
            ],
            [
                'name' => 'Old games',
                'parent_id' => 1,
                'child_count' => 0,
            ],
        ]);

        DB::table('category_product')->insert([
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 1,
                'category_id' => 2,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('categories');
    }
};
