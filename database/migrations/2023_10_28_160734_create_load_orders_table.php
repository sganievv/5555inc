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
        Schema::create('load_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('load_id');
            $table->foreignId('order_id');
            $table->string('tracking_number');

            $table->float('quantity');
            $table->boolean('is_accepted')->default(0);

            $table->timestamps();

            $table->foreign('load_id')
                ->on('loads')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('order_id')
                ->on('orders')
                ->references('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_orders');
    }
};
