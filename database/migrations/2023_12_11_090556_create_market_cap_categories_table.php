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
        Schema::create('market_cap_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1)->comment('s = small-cap, m = med-cap, l = large-cap');
            $table->decimal('tax_rate', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_cap_categories');
    }
};
