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
        Schema::create('products', function (Blueprint $table) {
            // $table->id(); //bigint,auto_increment,primary key,ten field :id
            $table->increments('id'); // int,auto_increment,primary key
            $table->String('name',200); // varchar(200),ten field: name
            $table->text('description');//text, ten field:description
            $table->timestamps();//created_at, update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
