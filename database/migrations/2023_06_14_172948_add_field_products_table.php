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
        //
        Schema::table('products',function(Blueprint $table){
            if(!Schema::hasColumn('products','content')){
                $table->text('content')->nullable()->after('description');
            }

            if(!Schema::hasColumn('products','status')){
                $table->boolean('status')->default(0)
                ->comment('Trang Thai:0-chua duyet,1-da duyet')
                ->after('content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('products',function(Blueprint $table){
            if(Schema::hasColumn('products','content')){
                $table->dropColumn('content');
            }

            if(Schema::hasColumn('products','status')){
                $table->dropColumn('status');
            }
        });
    }
};
