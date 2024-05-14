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
            'name' => 'Man',
            'child_count' => 5,
        ]);

        DB::table('categories')->insert([
            'name' => 'Woman',
            'child_count' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'T-shirt',
            'parent_id' => 1,
            'child_count' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'Cool T-shirt',
            'parent_id' => 3,
        ]);

        DB::table('categories')->insert([
            'name' => 'Not Cool T-shirt',
            'parent_id' => 3,
        ]);

        DB::table('categories')->insert([
            'name' => 'Dress',
            'parent_id' => 2,
        ]);

        DB::table('categories')->insert([
            'name' => 'Shorts',
            'parent_id' => 1,
        ]);

        DB::table('categories')->insert([
            'name' => 'Hats',
            'parent_id' => 1,
        ]);

        DB::table('categories')->insert([
            'name' => 'Hats',
            'parent_id' => 2,
        ]);


        DB::table('category_product')->insert([
            'product_id' => 1,
            'category_id' => 4,
        ]);

        DB::table('category_product')->insert([
            'product_id' => 2,
            'category_id' => 5,
        ]);

        DB::table('category_product')->insert([
            'product_id' => 3,
            'category_id' => 6,
        ]);

        DB::table('category_product')->insert([
            'product_id' => 4,
            'category_id' => 7,
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
