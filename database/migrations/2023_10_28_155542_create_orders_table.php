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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_number');

            $table->foreignId('user_id');
            $table->foreignId('storehouse_id')->nullable();

            $table->string('client_name');
            $table->string('client_city');
            $table->string('client_number');

            $table->string('name');
            $table->float('quantity');
            $table->float('weight');
            $table->enum('unit', ['kg', 'cube']);
            $table->float('price');
            $table->float('total_amount');

            $table->boolean('is_taken')->default(0);
            $table->text('comments')->nullable();

            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('storehouse_id')
                ->on('storehouses')
                ->references('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
