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
            $table->enum('status', ['processing', 'out for delivery', 'done'])->default('processing');
            $table->integer("amount");
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        // Schema::table('orders', function (Blueprint $table) {
        //     //
        //     $table->dropForeign('orders_user_id_foreign');
        // });


        Schema::dropIfExists('orders');
    }
};
