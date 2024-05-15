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
            $table->foreignId('attribute_template_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('value');
            $table->foreignId('attribute_set_id');
            $table->foreignId('product_id');
        });

        DB::table('attribute_templates')->insert([
            ['name' => 'game'],
            ['name' => 'releasedDate'],
            ['name' => 'type'],
            ['name' => 'duration'],
        ]);

        DB::table('attribute_sets')->insert([
            [
                'name' => 'Game',
                'attribute_template_id' => 1,
            ],
            [
                'name' => 'Date of release',
                'attribute_template_id' => 2,
            ],
            [
                'name' => 'Type',
                'attribute_template_id' => 3,
            ],
            [
                'name' => 'Duration',
                'attribute_template_id' => 4,
            ]
        ]);

        DB::table('attributes')->insert([
            [
                'value' => 'CS 1.6',
                'attribute_set_id' => 1,
                'product_id' => 1,
            ],
            [
                'value' => '2001 year',
                'attribute_set_id' => 2,
                'product_id' => 1,
            ],
            [
                'value' => 'Activation key',
                'attribute_set_id' => 3,
                'product_id' => 1,
            ],
            [
                'value' => 'Activation key',
                'attribute_set_id' => 3,
                'product_id' => 2,
            ],
            [
                'value' => 'Activation key',
                'attribute_set_id' => 3,
                'product_id' => 3,
            ],
            [
                'value' => '1 Month',
                'attribute_set_id' => 4,
                'product_id' => 2,
            ],
            [
                'value' => '7 Days',
                'attribute_set_id' => 4,
                'product_id' => 3,
            ]
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
