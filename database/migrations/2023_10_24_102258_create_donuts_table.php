<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donuts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->string('location');
            $table->string('state', 3);
            $table->string('type', 10);
            $table->text('details');
            $table->unsignedDecimal('rating_size', 3);
            $table->unsignedDecimal('rating_appearance', 3);
            $table->unsignedDecimal('rating_value', 3);
            $table->string('photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donuts');
    }
};
