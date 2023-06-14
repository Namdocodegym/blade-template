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
        // xoa default
        Schema::table('products',function(Blueprint $table){
            // xoa default
            $table->boolean('status')->default(null)->change();

            //xoa null
            $table->text('content')->nullable(false)->change();

            // can phai cai dat composer require doctrine/dbal 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products',function(Blueprint $table){
            // xoa default
            $table->boolean('status')->default(0)->change();

            //xoa null
            $table->text('content')->nullable()->change();

            // can phai cai dat composer require doctrine/dbal 
        });
    }
};
