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
        Schema::create('attribute_templates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
        });

        Schema::create('attribute_sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->foreignId('attribute_template_id');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('value');
            $table->foreignId('attribute_set_id');
            $table->foreignId('product_id');
        });

        DB::table('attribute_templates')->insert([
            'name' => 'description',
        ]);

        DB::table('attribute_templates')->insert([
            'name' => 'weight',
        ]);

        DB::table('attribute_sets')->insert([
            'name' => 'description',
            'attribute_template_id' => 1,
        ]);

        DB::table('attribute_sets')->insert([
            'name' => 'weight',
            'attribute_template_id' => 2,
        ]);

        DB::table('attributes')->insert([
            'value' => 'Good product',
            'attribute_set_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('attributes')->insert([
            'value' => '35',
            'attribute_set_id' => 2,
            'product_id' => 1,
        ]);

        DB::table('attributes')->insert([
            'value' => 'Good another product',
            'attribute_set_id' => 1,
            'product_id' => 2,
        ]);

        DB::table('attributes')->insert([
            'value' => '50',
            'attribute_set_id' => 2,
            'product_id' => 2,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_templates');
        Schema::dropIfExists('attribute_sets');
        Schema::dropIfExists('attributes');
    }
};
