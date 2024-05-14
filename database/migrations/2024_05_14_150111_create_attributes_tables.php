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
            $table->string('name');
        });

        Schema::create('attribute_sets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('attribute_template_id');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('attribute_set_id');
            $table->foreignId('product_id');
        });
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
