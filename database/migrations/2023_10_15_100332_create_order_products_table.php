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

        Schema::create('order_products', function (Blueprint $table) {
            

            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');      
            // $table->primary(['order_id', 'product_id']);

            $table->integer('quantity');
            // $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('order_products', function (Blueprint $table) {
        //     //
        //     $table->dropForeign('order_products_order_id_foreign');
        //     $table->dropForeign('order_products_product_id_foreign');            
        // });

       

        Schema::dropIfExists('order_products');
    }
};
