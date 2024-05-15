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
        Schema::create('attribute_set_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('attribute_set_id');
            $table->foreignId('category_id');
        });

        DB::table('attribute_set_category')->insert([
            [
                'attribute_set_id' => 1,
                'category_id' => 1,
            ],
            [
                'attribute_set_id' => 2,
                'category_id' => 1,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 1,
            ],
            [
                'attribute_set_id' => 1,
                'category_id' => 2,
            ],
            [
                'attribute_set_id' => 2,
                'category_id' => 2,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 2,
            ],
            [
                'attribute_set_id' => 1,
                'category_id' => 3,
            ],
            [
                'attribute_set_id' => 2,
                'category_id' => 3,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 3,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 4,
            ],
            [
                'attribute_set_id' => 4,
                'category_id' => 4,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 5,
            ],
            [
                'attribute_set_id' => 4,
                'category_id' => 5,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 6,
            ],
            [
                'attribute_set_id' => 4,
                'category_id' => 6,
            ],
            [
                'attribute_set_id' => 3,
                'category_id' => 7,
            ],
            [
                'attribute_set_id' => 4,
                'category_id' => 7,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes_categories');
    }
};
